<?php

namespace Aqamarine\AlphaNews\Tests\Models;

use App\Models\PostCategory;
use App\Models\Tag;
use App\Models\User;
use Aqamarine\AlphaNews\Tests\Factories\PostFactory;
use Aqamarine\AlphaNews\Traits\AlphaNewsPostTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $picture
 * @property string|null $short_title
 * @property string|null $short_content
 * @property int|null $post_category_id
 * @property int $author_id
 * @property int $is_trending_now
 * @property string|null $published_at
 * @property string|null $date_ico
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $author
 * @property-read PostCategory|null $category
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereAuthorId($value)
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDateIco($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereIsTrendingNow($value)
 * @method static Builder|Post wherePicture($value)
 * @method static Builder|Post wherePostCategoryId($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereShortContent($value)
 * @method static Builder|Post whereShortTitle($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Post extends Model
{
    use HasFactory, AlphaNewsPostTrait;

    protected $fillable = [
        'post_category_id', 'author_id', 'title', 'short_content', 'short_title', 'content', 'picture',
        'published_at', 'date_ico', 'is_trending_now', 'views', 'media_type'
    ];

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}
