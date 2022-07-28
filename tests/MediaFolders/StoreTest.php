<?php

namespace Aqamarine\AlphaNews\Tests\MediaFolders;

use Aqamarine\AlphaNews\Tests\Models\MediaFolder;

class StoreTest extends MediaFoldersTestCase
{
    protected string $testRouteName = 'store';

    public function testStore(): void
    {
        $this->post($this->url(), [
            'name' => 'GoodFolder'
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(MediaFolder::where([
            'name' => 'GoodFolder',
            'media_folder_id' => null,
        ])->exists());
    }

    public function testStoreValidation(): void
    {
        $countBefore = MediaFolder::count();
        $this->post($this->url(), [
            'name' => 1337,
            'media_folder_id' => 0,
        ], $this->jsonHeader)->assertStatus(422);
        self::assertSame($countBefore, MediaFolder::count());
    }

    public function testStoreValidationRequired(): void
    {
        $countBefore = MediaFolder::count();
        $this->post($this->url(), [], $this->jsonHeader)->assertStatus(422);
        self::assertSame($countBefore, MediaFolder::count());
    }

}
