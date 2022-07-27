<?php

namespace Aqamarine\AlphaNews\Tests;

use Aqamarine\AlphaNews\ServiceProvider;
use Aqamarine\AlphaNews\Tests\Migrations\CreateUsers;
use Aqamarine\AlphaNews\Tests\Models\Image;
use Aqamarine\AlphaNews\Tests\Models\MediaFolder;
use Aqamarine\AlphaNews\Tests\Models\Post;
use Aqamarine\AlphaNews\Tests\Models\PostCategory;
use Aqamarine\AlphaNews\Tests\Models\Tag;
use Aqamarine\AlphaNews\Tests\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;

class AlphaNewsTestCase extends TestCase
{
    use RefreshDatabase;

    protected string $packageRouteName = 'alphanews';
    public array $jsonHeader = ['accept' => "application/json"];
    protected array|string|int $routeParameters = [];

    protected User $user;
    protected string $testCaseRouteName;
    protected string $testRouteName;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function url($additionalRoute = ''): string
    {
        return route(
            $this->packageRouteName.'.'.$this->testCaseRouteName.'.'.$this->testRouteName.$additionalRoute,
            $this->routeParameters
        );
    }

    protected function setParameters(string|int $key, mixed $value): void
    {
        $this->routeParameters[$key] = $value;
    }

    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $this->setConfig($app);
        $this->migrate();
    }

    private function migrate(): void
    {
        (new CreateUsers())->up();
        (include __DIR__ . '/../database/migrations/2022_07_25_092032_create_post_categories.php')->up();
        (include __DIR__ . '/../database/migrations/2022_07_25_092036_create_posts.php')->up();
        (include __DIR__ . '/../database/migrations/2022_07_25_103834_create_tags.php')->up();
        (include __DIR__ . '/../database/migrations/2022_07_25_103935_create_post_tag.php')->up();
        (include __DIR__ . '/../database/migrations/2022_07_26_130405_create_media_folders.php')->up();
        (include __DIR__ . '/../database/migrations/2022_07_26_132522_create_images.php')->up();
    }

    private function setConfig($app): void
    {
        $app['config']->set('app.key', 'base64:nXRgrnH481Fce7gJME6MQbIfBTqXeBYbz6DHwP7m2gQ=');
        $app['config']->set('cache.default', 'array');
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('alphanews.models', [
            'user' => User::class,
            'post' => Post::class,
            'post_category' => PostCategory::class,
            'tag' => Tag::class,
            'media_folder' => MediaFolder::class,
            'image' => Image::class,
        ]);
    }
}
