<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupation extends Model
{
    protected $fillable = ([
        'ocupation_name',
    ]);

    public function users()
    {
        return $this
                ->hasMany('App\User');
    }
}
