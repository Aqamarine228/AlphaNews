<?php

namespace Aqamarine\AlphaNews\Tests\Posts;

use Aqamarine\AlphaNews\Tests\Models\Post;
use Aqamarine\AlphaNews\Tests\Models\PostCategory;

class PublishTest extends PostsTestCase
{
    protected string $testRouteName = 'publish';

    public function testPublish(): void
    {
        $postCategory = PostCategory::factory()->create();
        $postsAmount = $postCategory->posts_amount;
        $post = Post::factory()->state([
            'published_at' => null,
            'post_category_id' => $postCategory->id
        ])->create();
        $this->routeParameters = [
            'id' => $post->id
        ];
        $this->post($this->url(), [
            'date' => date('Y-m-d')
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue((bool)Post::find($post->id)->published_at);
        self::assertSame($postsAmount + 1, PostCategory::find($postCategory->id)->posts_amount);
    }

    public function testPublishNotPublishable(): void
    {
        $post = Post::factory()->emptyPost()->create();
        $this->routeParameters = [
            'id' => $post->id
        ];
        $this->post($this->url(), [], $this->jsonHeader)->assertStatus(404);
    }

}
