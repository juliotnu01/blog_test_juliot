<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    function hasManyTags()
    {
        return $this->hasMany(TagPhotos::class, 'photo_id');
    }
}
