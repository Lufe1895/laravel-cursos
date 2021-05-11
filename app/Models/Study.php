<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
        'study_level',
    ];

    public function users()
    {
        return $this
                ->hasMany('App\User')
                ->withTimeStamps();
    }
}