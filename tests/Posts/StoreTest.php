<?php

namespace Aqamarine\AlphaNews\Tests\Posts;

use Aqamarine\AlphaNews\Tests\Models\Post;

class StoreTest extends PostsTestCase
{
    protected string $testRouteName = 'store';

    public function testStore(): void
    {
        $this->post($this->url())->assertStatus(302);
        self::assertTrue(Post::whereAuthorId($this->user->id)
            ->whereNull('post_category_id')
            ->whereNull('title')
            ->whereNull('content')
            ->whereNull('short_title')
            ->whereNull('short_content')
            ->whereNull('picture')
            ->exists());
    }

}
