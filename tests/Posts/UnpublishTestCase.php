<?php

namespace Aqamarine\AlphaNews\Tests\Posts;

use Aqamarine\AlphaNews\Tests\Models\Post;

class UnpublishTestCase extends PostsTestCase
{

    protected string $testRouteName = 'unpublish';

    public function testUnpublish(): void
    {
        $post = Post::factory()->create();
        $this->routeParameters = [
            'id' => $post->id
        ];
        $this->post($this->url(), [], $this->jsonHeader)->assertStatus(302);
        self::assertFalse((bool)Post::find($post->id)->published_at);
    }
}
