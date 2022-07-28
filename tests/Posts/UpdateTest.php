<?php

namespace Aqamarine\AlphaNews\Tests\Posts;

use Aqamarine\AlphaNews\Enums\PostMediaType;
use Aqamarine\AlphaNews\Tests\Models\Post;
use Aqamarine\AlphaNews\Tests\Models\PostCategory;
use Aqamarine\AlphaNews\Tests\Models\Tag;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UpdateTest extends PostsTestCase
{
    protected string $testRouteName = 'update.';
    protected Post $emptyPost;

    protected function setUp(): void
    {
        parent::setUp();
        $this->emptyPost = Post::factory()->emptyPost()->create();
        $this->routeParameters = [
            'id' => $this->emptyPost->id
        ];
    }

    public function testUpdateContent(): void
    {
        $this->put($this->url('content'), [
            'title' => 'GoodPost',
            'content' => 'GoodContent',
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(Post::where([
            'id' => $this->emptyPost->id,
            'title' => 'GoodPost',
            'content' => 'GoodContent',
        ])->exists());
    }

    public function testUpdatePreview(): void
    {
        $this->put($this->url('preview'), [
            'short_title' => 'GoodShortTitle',
            'short_content' => 'GoodShortContent',
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(Post::where([
            'id' => $this->emptyPost->id,
            'short_title' => 'GoodShortTitle',
            'short_content' => 'GoodShortContent',
        ])->exists());
    }

    public function testUpdateCategory(): void
    {
        $newPostCategory = PostCategory::factory()->create();
        $this->put($this->url('category'), [
            'post_category_id' => $newPostCategory->id,
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(Post::where([
            'id' => $this->emptyPost->id,
            'post_category_id' => $newPostCategory->id,
        ])->exists());
    }

    public function testUpdateMediaType(): void
    {
        $this->put($this->url('media-type'), [
            'media_type' => PostMediaType::Photo->value
        ], $this->jsonHeader)->assertStatus(302);
        self::assertTrue(Post::where([
            'id' => $this->emptyPost->id,
            'media_type' => PostMediaType::Photo->value
        ])->exists());
    }

    public function testUpdateTags(): void
    {
        $tags = [
            'good_tag_first',
            'good_tag_second',
            'good_tag_third'
        ];
        $this->put($this->url('tags'), [
            'tags' => $tags
        ], $this->jsonHeader)->assertStatus(302);
        foreach ($tags as $tag) {
            self::assertTrue(Tag::whereName($tag)->exists());
            self::assertTrue($this->emptyPost->tags()->whereName($tag)->exists());
        }
    }

    public function testUpdateImage(): void
    {
        $this->put($this->url('image'), [
            'picture' => UploadedFile::fake()->image('goodImage.jpg'),
            'width' => 1080,
            'height' => 720,
            'x1' => 0,
            'y1' => 0,
        ], $this->jsonHeader)->assertStatus(302);
        $imageName = Post::find($this->emptyPost->id)->picture;
        self::assertTrue(Storage::disk(Config::get('alphanews.posts.filesystem.disk'))
            ->exists(Config::get('alphanews.posts.filesystem.preview_images_path') . $imageName));
        self::assertTrue(Storage::disk(Config::get('alphanews.posts.filesystem.disk'))
            ->exists(Config::get('alphanews.posts.filesystem.original_images_path') . $imageName));
    }

    public function testUpdateMain(): void
    {
        $publishedPostId = Post::factory()->create()->id;
        $this->routeParameters['id'] = $publishedPostId;
        $this->put($this->url('main'), [], $this->jsonHeader)->assertStatus(302);
        self::assertTrue((bool)Post::find($publishedPostId)->is_trending_now);
    }

    public function testUpdateMainNotPublished(): void
    {
        $this->put($this->url('main'), [], $this->jsonHeader)->assertStatus(302);
        self::assertFalse((bool)Post::find($this->emptyPost->id)->is_trending_now);
    }
}
