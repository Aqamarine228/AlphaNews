<?php

namespace Aqamarine\AlphaNews\Tests\PostCategories;

use Aqamarine\AlphaNews\Tests\Models\PostCategory;

class DestroyTest extends PostCategoriesTestCase
{
    protected string $testRouteName = 'destroy';

    public function setUp(): void
    {
        parent::setUp();
        $this->routeParameters = [
            'id' => $this->postCategory->id,
        ];
    }

    public function testDestroy(): void
    {
        $this->delete($this->url());
        self::assertFalse(PostCategory::whereId($this->postCategory->id)->exists());
    }

}
