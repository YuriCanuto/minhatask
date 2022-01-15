<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

use App\Traits\User\HasAuthor;

class MediaLibrary extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasAuthor;

    protected $table = 'media_library';

    protected $fillable = [
        'user_id'
    ];

    /**
     * MediaLibrary
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CROP, 360, 360)
             ->quality(85)
             ->nonQueued();

        $this->addMediaConversion('photo')
             ->width(940)
             ->quality(85)
             ->nonQueued();
    }

    /**
     * Accesors
     */
    public function getThumbAttribute()
    {
        $image = $this->getFirstMedia('medialibrary');
        return isset($image) ? $image->getUrl('thumb') : null;
    }

    public function getUrlAttribute()
    {
        $image = $this->getFirstMedia('medialibrary');
        return isset($image) ? $image->getUrl('photo') : null;
    }
}
