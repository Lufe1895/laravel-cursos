<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'start_date',
        'finish_date',
        'hours',
        'description',
        'status_id',
        'type_id',
        'tutor_id',
        'image',
    ];
    
    public function users()
    {
        return $this
                ->belongsToMany('App\User');
    }

    public function status()
    {
        return $this
                ->belongsTo('App\Models\Status');
    }

    public function type()
    {
        return $this
                ->belongsTo('App\Models\Type');
    }

    public function tutor()
    {
        return $this
                ->belongsTo('App\Models\Tutor');
    }
}
