<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'name',
        'academic_profile',
    ];

    public function course()
    {
        return $this->hasMany('App\Models\Course');
    }
}
