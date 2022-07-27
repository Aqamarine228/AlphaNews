<?php

namespace Aqamarine\AlphaNews\Tests\PostCategories;

use Aqamarine\AlphaNews\Tests\Models\PostCategory;

class StoreTest extends PostCategoriesTestCase
{
    protected string $testRouteName = 'store';

    public function testStore(): void
    {
        $this->post($this->url(), [
            'color' => 'GoodColor',
            'name' => 'GoodName',
            'post_category_id' => $this->postCategory->id
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(PostCategory::where([
            'color' => 'GoodColor',
            'name' => 'GoodName',
            'post_category_id' => $this->postCategory->id,
        ])->exists());
    }

    public function testStoreValidationRequired(): void
    {
        $countBefore = PostCategory::count();
        $this->post($this->url(), [], $this->jsonHeader)->assertStatus(422);
        self::assertSame($countBefore, PostCategory::count());
    }

    public function testStoreValidation(): void
    {
        $countBefore = PostCategory::count();
        $this->post($this->url(), [
            'name' => 1337,
            'color' => 1337,
            'parent_category_id' => 0
        ], $this->jsonHeader)->assertStatus(422);
        self::assertSame($countBefore, PostCategory::count());
    }
}
