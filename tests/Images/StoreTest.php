<?php

namespace Aqamarine\AlphaNews\Tests\Images;

use Aqamarine\AlphaNews\Tests\Models\Image;
use Illuminate\Http\UploadedFile;

class StoreTest extends ImagesTestCase
{
    protected string $testRouteName = 'store';

    public function testStore(): void
    {
        $this->post($this->url(), [
            'media_folder_id' => $this->mediaFolder->id,
            'images' => [
                UploadedFile::fake()->image('goodImage.jpg'),
                UploadedFile::fake()->image('veryGoodImage.jpg'),
                UploadedFile::fake()->image('anotherGoodImage.jpg'),
            ],
        ], $this->jsonHeader)->assertStatus(302);
        self::assertSame(Image::whereMediaFolderId($this->mediaFolder->id)->count(), 3);
    }

    public function testStoreValidation(): void
    {
        $this->post($this->url(), [
            'media_folder_id' => 0,
            'images' => 1337
        ], $this->jsonHeader)->assertStatus(422);
    }

    public function testStoreValidationRequired(): void
    {
        $this->post($this->url(), [], $this->jsonHeader)->assertStatus(422);
    }
}
