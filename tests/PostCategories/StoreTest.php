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
        ])->assertStatus(302);
        self::assertTrue(PostCategory::where([
            'color' => 'GoodColor',
            'name' => 'GoodName',
            'parent_category_id' => null,
        ])->exists());
    }

    public function testStoreValidation(): void
    {
        $this->post($this->url(), [
            'color' => '',
            'name' => '',
            'prent_category_id' => 0,
        ], $this->jsonHeader)->assertStatus(422);
    }

}
