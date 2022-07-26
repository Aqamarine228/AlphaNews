<?php

namespace Aqamarine\AlphaNews\Tests\Factories;

use Aqamarine\AlphaNews\Tests\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 *
 * @mixin PostCategory
 */
class PostCategoryFactory extends Factory
{
    protected $model = PostCategory::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle,
            'color' => $this->faker->colorName,
            'posts_amount' => $this->faker->randomNumber(),
            'parent_category_id' => null,
        ];
    }
}
