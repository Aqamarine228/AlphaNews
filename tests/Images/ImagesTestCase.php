<?php
namespace Aqamarine\AlphaNews\Tests\Images;

use Aqamarine\AlphaNews\Tests\AlphaNewsTestCase;
use Aqamarine\AlphaNews\Tests\Models\MediaFolder;

class ImagesTestCase extends AlphaNewsTestCase
{
    protected string $testCaseRouteName = 'media-folders.images';

    protected MediaFolder $mediaFolder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mediaFolder = MediaFolder::factory()->create();
    }
}
