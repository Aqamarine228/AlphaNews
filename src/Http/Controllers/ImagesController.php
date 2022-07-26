<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ImagesController extends AlphaNewsController
{
    protected mixed $imageModel;
    protected mixed $mediaFolderModel;

    public function __construct()
    {
        $this->imageModel = Config::get('alphanews.models.image');
        $this->mediaFolderModel = Config::get('alphanews.models.media_folder');
    }

    /**
     * @throws ValidationException
     */
    public function store(): RedirectResponse
    {
        $fields = $this->validate(request(), [
            'media_folder_id' => 'required|exists:'.(new $this->mediaFolderModel)->getTable().',id',
            'images.*' => 'required|image|max:5120',
        ]);

        foreach ($fields['images'] as $image) {
            $imageName = $this->uploadImage($image);

            $this->imageModel::create([
                Config::get('alphanews.foreign_keys.media_folder') => $fields['media_folder_id'],
                'name' => $imageName
            ]);
        }

        return back();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ValidationException
     */
    public function storeFromTinymce(): array
    {
        $fields = $this->validate(request(), [
            'file' => 'required|image|max:5120',
        ]);

        $folderId = $this->getFolderId(request()->get('news_id'));

        $imageName = $this->uploadImage($fields['file']);

        $image = $this->imageModel::create([
            Config::get('alphanews.foreign_keys.media_folder') => $folderId,
            'name' => $imageName
        ]);

        return [
            'location' => $image->getFullUrl()
        ];
    }

    private function getFolderId($newsId): int
    {
        return $newsId ? $this->mediaFolderModel::firstOrCreate([
            'name' => $newsId,
            'media_folder_id' => Config::get('alphanews.media.folders.news'),
        ])->id : Config::get('alphanews.media.folders.news');
    }

    private function uploadImage(UploadedFile $image): string
    {
        $imageName = Str::random(10) . ' _ ' . time() . '.png';
        Storage::disk(Config::get('alphanews.media.filesystem.disk'))->put(
            Config::get('alphanews.media.filesystem.images_path') . '/' . $imageName,
            $image->getContent()
        );

        return $imageName;
    }
}
