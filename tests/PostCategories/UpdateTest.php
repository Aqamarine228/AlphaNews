<?php

namespace Aqamarine\AlphaNews\Tests\PostCategories;

use Aqamarine\AlphaNews\Tests\Models\PostCategory;

class UpdateTest extends PostCategoriesTestCase
{
    protected string $testRouteName = 'update';


    public function setUp(): void
    {
        parent::setUp();
        $this->routeParameters = [
            'id' => $this->postCategory->id
        ];
    }

    public function testUpdate(): void
    {
        $this->put($this->url(), [
            'name' => 'GoodName',
            'color' => 'GoodColor',
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(PostCategory::where([
            'id' => $this->postCategory->id,
            'name' => 'GoodName',
            'color' => 'GoodColor',
        ])->exists());
    }

    public function testUpdateValidation(): void
    {
        $this->put($this->url(), [], $this->jsonHeader)->assertStatus(302);
        $newPostCategory = PostCategory::find($this->postCategory->id);
        self::assertSame($this->postCategory->name, $newPostCategory->name);
        self::assertSame($this->postCategory->color, $newPostCategory->color);
    }

}
