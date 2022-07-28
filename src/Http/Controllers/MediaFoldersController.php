<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MediaFoldersController extends AlphaNewsController
{
    protected mixed $mediaFolderModel;
    protected mixed $imageModel;

    public function __construct()
    {
        $this->mediaFolderModel = Config::get('alphanews.models.media_folder');
        $this->imageModel = Config::get('alphanews.models.image');
    }

    public function index(?int $id = null): Factory|View|Application
    {
        $rootFolder = $id ? $this->mediaFolderModel::find($id) : null;
        $subFolders = $this->mediaFolderModel::where(
            Config::get('alphanews.foreign_keys.media_folder'),
            $id
        )->paginate();
        $images = $this->imageModel::where(Config::get('alphanews.foreign_keys.media_folder'), $id)->get();

        return $this->view('media-folders.index', [
            'rootFolder' => $rootFolder,
            'subFolders' => $subFolders,
            'images' => $images,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(): RedirectResponse
    {
        // deny for advert folder
        $mediaFolderTable = (new $this->mediaFolderModel)->getTable();
        $validated = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255', Rule::unique($mediaFolderTable)->where(function ($query) {
                $query->where(
                    Config::get('alphanews.foreign_keys.media_folder'),
                    request()->get(Config::get('alphanews.foreign_keys.media_folder'))
                );
            })],
            'media_folder_id' => 'nullable|exists:'.$mediaFolderTable.',id'
        ]);

        $this->mediaFolderModel::create([
            'name' => $validated['name'],
            Config::get('alphanews.foreign_keys.media_folder') => $validated['media_folder_id'] ?? null
        ]);

        return back();
    }
}
