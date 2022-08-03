<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Aqamarine\AlphaNews\Http\Requests\TagRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class TagsController extends AlphaNewsController
{
    protected mixed $tagModel;

    public function __construct()
    {
        $this->tagModel = Config::get('alphanews.models.tag');
    }

    public function index(): Factory|View|Application
    {
        $tags = $this->tagModel::orderBy('posts_amount', 'desc')->paginate(20);

        return $this->view('tags.index', [
            'tags' => $tags,
        ]);
    }

    public function create(): View|Factory|Application
    {
        return $this->view('tags.create');
    }

    public function store(TagRequest $request): RedirectResponse
    {
        $name = Str::snake($request->validated()['name']);

        if ($this->tagModel::whereName($name)->exists()) {
            $this->showErrorMessage("Tag with same name already exists (tag names are auto formatted in snake case)");
            return back();
        }

        $this->tagModel::create([
            'name' => $name,
        ]);
        $this->showSuccessMessage('Tag successfully created.');

        return redirect()->route('alphanews.tags.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $tag = $this->tagModel::findOrFail($id);
        if (!$tag->posts()->exists()) {
            $tag->delete();
            $this->showSuccessMessage('Tag successfully deleted');
        } else {
            $this->showWarningMessage('Can not delete tag with posts');
        }

        return back();
    }
}
