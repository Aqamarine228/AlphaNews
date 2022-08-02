<?php

namespace Aqamarine\AlphaNews\Tests\Models;

use Aqamarine\AlphaNews\Tests\Factories\MediaFolderFactory;
use Aqamarine\AlphaNews\Traits\AlphaNewsMediaFolderTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\MediaFolder
 *
 * @property int $id
 * @property string $name
 * @property int|null $media_folder_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|self newModelQuery()
 * @method static Builder|MediaFolder newQuery()
 * @method static Builder|MediaFolder query()
 * @method static Builder|MediaFolder whereCreatedAt($value)
 * @method static Builder|MediaFolder whereId($value)
 * @method static Builder|MediaFolder whereMediaFolderId($value)
 * @method static Builder|MediaFolder whereName($value)
 * @method static Builder|MediaFolder whereUpdatedAt($value)
 * @mixin Eloquent
 */

class MediaFolder extends Model
{
    use HasFactory, AlphaNewsMediaFolderTrait;

    protected static function newFactory(): MediaFolderFactory
    {
        return MediaFolderFactory::new();
    }
}
