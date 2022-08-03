<?php

namespace Aqamarine\AlphaNews\Tests\Tags;

use Aqamarine\AlphaNews\Tests\Models\Tag;

class StoreTest extends TagsTestCase
{

    protected string $testRouteName = 'store';

    public function testStore(): void
    {
        $this->post($this->url(), [
            'name' => 'GoodTag',
        ])->assertStatus(302);
        self::assertTrue(Tag::whereName('good_tag')->exists());
    }

    public function testStoreValidationRequired(): void
    {
        $countBefore = Tag::count();
        $this->post($this->url(), [], $this->jsonHeader)->assertStatus(422);
        self::assertSame($countBefore, Tag::count());
    }

    public function testStoreValidation(): void
    {
        $countBefore = Tag::count();
        $this->post($this->url(), [
            'name' => 1337
        ], $this->jsonHeader)->assertStatus(422);
        self::assertSame($countBefore, Tag::count());
    }
}
