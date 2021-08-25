<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public function belongstoRole(){
        return $this->belongsTo(Role::class, 'role_id');
    }
}
