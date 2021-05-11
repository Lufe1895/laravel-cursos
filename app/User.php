<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'api_token', 'password', 'phone_number', 'city', 'sex', 'age', 'ocupation_id', 'study_id', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this
                ->belongsToMany('App\Models\Course');
    }

    public function ocupation()
    {
        return $this
                ->belongsTo('App\Models\Ocupation');
    }

    public function study()
    {
        return $this
                ->belongsTo('App\Models\Study');
    }

    public function role()
    {
        return $this
                ->belongsToMany('App\Models\Role');
    }
}
