<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Aqamarine\AlphaNews\Http\Requests\PostCategoryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class PostCategoriesController extends AlphaNewsController
{
    protected mixed $postCategoryModel;

    public function __construct()
    {
        $this->postCategoryModel = Config::get('alphanews.models.post_category');
    }

    public function index(?int $id = null): View|Factory|Application
    {
        $category = $id ? $this->postCategoryModel::findOrFail($id) : new $this->postCategoryModel;
        $postCategories = $this->postCategoryModel::where(
            Config::get('alphanews.foreign_keys.post_category'),
            $category->id
        )
            ->withCount('childCategories')
            ->withCount(['posts'])
            ->latest()
            ->paginate();

        return $this->view('post-categories.index', [
            'categories' => $postCategories,
            'rootCategory' => $category,
        ]);
    }

    public function create(): Factory|View|Application
    {
        $categories = $this->postCategoryModel::pluck('name', 'id');

        return $this->view('post-categories.create', [
            'categories' => $categories,
        ]);
    }

    public function store(PostCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->postCategoryModel::create([
            'name' => $validated['name'],
            'color' => $validated['color'],
            Config::get('alphanews.foreign_keys.post_category') => $validated['post_category_id']
        ]);
        $this->showSuccessMessage('Category successfully created.');

        return redirect()->route('alphanews.post-categories.index');
    }

    public function edit(int $id): Factory|View|Application
    {
        $postCategory = $this->postCategoryModel::findOrFail($id);
        return $this->view('post-categories.edit', [
            'postCategory' => $postCategory,
            'categories' => $this->postCategoryModel::pluck('name', 'id'),
        ]);
    }

    public function update(PostCategoryRequest $request, int $id): RedirectResponse
    {

        $this->postCategoryModel::findOrFail($id)->update($request->validated());
        $this->showSuccessMessage('Category successfully updated.');

        return back();
    }

    public function destroy(int $id): RedirectResponse
    {
        $postCategory = $this->postCategoryModel::findOrFail($id);
        if ($postCategory->posts()->exists()) {
            $this->showWarningMessage('Can not delete category with posts');
        } elseif ($postCategory->childCategories()->exists()) {
            $this->showWarningMessage('Can not delete parent category');
        } else {
            $postCategory->delete();
            $this->showSuccessMessage('Category successfully deleted');
        }

        return back();
    }
}
