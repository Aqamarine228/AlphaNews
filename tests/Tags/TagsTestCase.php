<?php

namespace Aqamarine\AlphaNews\Tests\Tags;

use Aqamarine\AlphaNews\Tests\AlphaNewsTestCase;
use Aqamarine\AlphaNews\Tests\Models\Tag;

class TagsTestCase extends AlphaNewsTestCase
{
    protected Tag $tag;

    protected string $testCaseRouteName = 'tags';

    protected function setUp(): void
    {
        parent::setUp();
        $this->tag = Tag::factory()->create();
    }
}
