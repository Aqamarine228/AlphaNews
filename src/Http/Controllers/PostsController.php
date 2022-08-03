<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Aqamarine\AlphaNews\Enums\PostMediaType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\ValidationException;
use Throwable;

class PostsController extends AlphaNewsController
{
    protected mixed $postModel;
    protected mixed $postCategoryModel;
    protected mixed $tagModel;

    public function __construct()
    {
        $this->postModel = Config::get('alphanews.models.post');
        $this->postCategoryModel = Config::get('alphanews.models.post_category');
        $this->tagModel = Config::get('alphanews.models.tag');
    }

    public function index(Request $request): Factory|View|Application
    {
        $posts = $this->postModel::where(Config::get('alphanews.foreign_keys.user'), $request->user()->id)
            ->latest()
            ->paginate(20);

        return $this->view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function indexAllPosts(): Factory|View|Application
    {
        $posts = $this->postModel::latest()->paginate(20);

        return $this->view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function edit(int $id): Factory|View|Application
    {
        $post = $this->postModel::findOrFail($id);
        return $this->view('posts.edit', [
            'post' => $post,
            'categories' => $this->postCategoryModel::pluck('name', 'id'),
            'postTags' => $post->tags()->pluck('name'),
            'postMediaTypes' => collect(PostMediaType::cases())->pluck('name', 'value')
        ]);
    }

    /**
     * @throws Throwable
     */
    public function mainPost(int $id): RedirectResponse
    {
        $post = $this->postModel::findOrFail($id);
        if (!$post->isPublished()) {
            $this->showWarningMessage('Can not make this News main because it is not published yet');
            return back();
        }

        DB::transaction(function () use ($post) {
            $this->postModel::where('is_trending_now', 1)->update(['is_trending_now' => false]);
            $post->update(['is_trending_now' => true]);
        });

        $this->showSuccessMessage($post->short_title . ' is the main post now');
        return back();
    }

    /**
     * @throws ValidationException
     */
    public function updateContent(int $id): RedirectResponse
    {
        $validated = $this->validate(request(), [
            'title' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $this->postModel::findOrFail($id)->update($validated);

        return back();
    }

    /**
     * @throws ValidationException
     */
    public function updatePreview(int $id): RedirectResponse
    {
        $validated = $this->validate(request(), [
            'short_title' => 'nullable|string|max:255',
            'short_content' => 'nullable|string|max:255',
        ]);

        $this->postModel::findOrFail($id)->update($validated);

        return back();
    }

    /**
     * @throws ValidationException
     */
    public function updateCategory(int $id): RedirectResponse
    {
        $validated = $this->validate(request(), [
            'post_category_id' => 'required|integer|exists:' . (new $this->postCategoryModel)->getTable() . ',id',
        ]);

        $this->postModel::findOrFail($id)->update($validated);

        return back();
    }

    /**
     * @throws ValidationException
     */
    public function updateMediaType(int $id): RedirectResponse
    {
        $validated = $this->validate(request(), [
            'media_type' => [
                'required',
                new Enum(PostMediaType::class)
            ]
        ]);

        $this->postModel::findOrFail($id)->update($validated);

        return back();
    }

    /**
     * @throws ValidationException
     */
    public function updateImage(int $id): RedirectResponse
    {
        $post = $this->postModel::findOrFail($id);
        $validated = $this->validate(request(), [
            'picture' => ['required', 'image', 'max:4096'],
//            'width' => 'required|numeric',
//            'height' => 'required|numeric',
//            'x1' => 'required|numeric',
//            'y1' => 'required|numeric'
        ]);

        $imageName = $this->cropAndUploadImagesByName(
            $validated['picture'],
            $post->id,
        );

        $post->update([
            'picture' => $imageName
        ]);
        // TODO: delete old picture

        return back();
    }

    protected function cropAndUploadImagesByName(UploadedFile $image, int $postId): string
    {
        $fileName = $postId . '_' . time() . '.png';

        $image = Image::make($image)->crop(...array_values(request()->only(['width', 'height', 'x1', 'y1'])));

        $previewImage = clone $image;
        $previewImage = $previewImage->resize(
            Config::get('alphanews.posts.preview_images_height'),
            null,
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        )
            ->encode('png');
        $originalImage = $image->encode('png');

        Storage::disk(Config::get('alphanews.posts.filesystem.disk'))
            ->put(
                Config::get('alphanews.posts.filesystem.preview_images_path') . '/' . $fileName,
                $previewImage->stream()
            );
        Storage::disk(Config::get('alphanews.posts.filesystem.disk'))
            ->put(
                Config::get('alphanews.posts.filesystem.original_images_path') . '/' . $fileName,
                $originalImage->stream()
            );

        return $fileName;
    }

    /**
     * @throws ValidationException
     */
    public function updateTags(int $id): RedirectResponse
    {
        $validated = $this->validate(request(), [
            'tags' => 'nullable|array',
            'tags.*' => 'required|exists:tags,name'
        ]);

        $this->postModel::findOrFail($id)->tags()->sync($this->getTagIdsByNames($validated['tags'] ?? []));

        return back();
    }

    public function store(Request $request): RedirectResponse
    {
        $post = $this->getEmptyPost($request->user());
        if ($post === null) {
            $post = $this->postModel::create([
                Config::get('alphanews.foreign_keys.user') => $request->user()->id,
            ]);
        }

        return redirect()->route('alphanews.posts.edit', $post->id);
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->postModel::findOrFail($id)->delete();
        $this->showSuccessMessage('Post deleted successfully');
        return redirect()->route('alphanews.posts.index');
    }

    private function getEmptyPost(mixed $user): mixed
    {
        $emptyPost = $this->postModel::where(Config::get('alphanews.foreign_keys.user'), $user->id)
            ->whereNull(Config::get('alphanews.foreign_keys.post_category'))
            ->whereNull('title')
            ->whereNull('content')
            ->whereNull('short_title')
            ->whereNull('short_content')
            ->whereNull('picture')
            ->latest()
            ->first();

        if ($emptyPost !== null && $emptyPost->tags()->count() === 0) {
            return $emptyPost;
        }

        return null;
    }

    private function getTagIdsByNames(array $names): array
    {
        $ids = [];
        foreach ($names as $name) {
            $tag = $this->tagModel::firstOrCreate([
                'name' => Str::snake($name),
            ]);
            $ids[] = $tag->id;
        }

        return $ids;
    }
}
