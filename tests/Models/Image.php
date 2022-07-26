<?php

namespace Aqamarine\AlphaNews\Tests\Models;

use Aqamarine\AlphaNews\Traits\AlphaNewsImageTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $name
 * @property int $media_folder_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|self newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereMediaFolderId($value)
 * @method static Builder|Image whereName($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    use AlphaNewsImageTrait;

    protected $fillable = ['media_folder_id', 'name'];
}
