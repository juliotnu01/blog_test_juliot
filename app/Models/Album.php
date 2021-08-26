<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];

    public function belongsToLocation(){
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function belongsToMember(){
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function hasMamyPhotos(){
        return $this->hasMany(Photo::class, 'album_id');
    }

}
