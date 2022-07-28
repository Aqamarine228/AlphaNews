<?php

namespace Aqamarine\AlphaNews\Tests\PostCategories;

use Aqamarine\AlphaNews\Tests\AlphaNewsTestCase;
use Aqamarine\AlphaNews\Tests\Models\PostCategory;

class PostCategoriesTestCase extends AlphaNewsTestCase
{
    protected string $testCaseRouteName = 'post-categories';

    protected PostCategory $postCategory;

    public function setUp(): void
    {
        parent::setUp();
        $this->postCategory = PostCategory::factory()->create();
    }
}
