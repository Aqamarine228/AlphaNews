<?php

namespace Aqamarine\AlphaNews\Tests\Factories;

use Aqamarine\AlphaNews\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];
    }
}
