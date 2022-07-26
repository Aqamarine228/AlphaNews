<?php

namespace Aqamarine\AlphaNews\Tests\Factories;

use Aqamarine\AlphaNews\Tests\Models\Post;
use Aqamarine\AlphaNews\Tests\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 *
 * @mixin Post
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text(300),
            'picture' => $this->faker->word(). '.jpeg',
            'short_title' => $this->faker->sentence(3),
            'short_content' => $this->faker->sentence(10),
            'author_id' => User::first()->id,
            'date_ico' => $this->faker->dateTimeBetween('-1 year', '1 year'),
            'is_trending_now' => false,
            'published_at' => now()->subHours(random_int(1, 20))->subMinutes(random_int(1, 60)),
            'views' => $this->faker->numberBetween(0, 50),
            'likes' => $this->faker->numberBetween(0, 20)
        ];
    }
}
