<?php

namespace Aqamarine\AlphaNews\Tests\Factories;

use Aqamarine\AlphaNews\Tests\Models\MediaFolder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 *
 * @mixin MediaFolder
 */
class MediaFolderFactory extends Factory
{

    protected $model = MediaFolder::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'media_folder_id' => null
        ];
    }
}
