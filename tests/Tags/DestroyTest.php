<?php

namespace Aqamarine\AlphaNews\Tests\Tags;

use Aqamarine\AlphaNews\Tests\Models\Tag;

class DestroyTest extends TagsTestCase
{

    protected string $testRouteName = 'destroy';

    protected function setUp(): void
    {
        parent::setUp();
        $this->routeParameters = [
            'id' => $this->tag->id
        ];
    }

    public function testDestroy(): void
    {
        $this->delete($this->url())->assertStatus(302);
        self::assertFalse(Tag::whereId($this->tag->id)->exists());
    }
}
