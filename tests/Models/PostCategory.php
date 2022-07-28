<?php

namespace Aqamarine\AlphaNews\Tests\Models;

use Aqamarine\AlphaNews\Tests\Factories\PostCategoryFactory;
use Aqamarine\AlphaNews\Traits\AlphaNewsPostCategoryTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PostCategory
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int|null $parent_category_id
 * @property int $posts_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|PostCategory[] $childCategories
 * @property-read int|null $child_categories_count
 * @property-read Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @method static Builder|PostCategory newModelQuery()
 * @method static Builder|PostCategory newQuery()
 * @method static Builder|PostCategory query()
 * @method static Builder|PostCategory whereColor($value)
 * @method static Builder|PostCategory whereCreatedAt($value)
 * @method static Builder|PostCategory whereId($value)
 * @method static Builder|PostCategory whereName($value)
 * @method static Builder|PostCategory whereParentCategoryId($value)
 * @method static Builder|PostCategory wherePostsAmount($value)
 * @method static Builder|PostCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PostCategory extends Model
{
    use HasFactory, AlphaNewsPostCategoryTrait;

    protected $fillable = ['name', 'color', 'posts_amount', 'post_category_id'];

    protected static function newFactory(): PostCategoryFactory
    {
        return PostCategoryFactory::new();
    }
}
