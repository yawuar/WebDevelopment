<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $primaryKey = 'user_id';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'address', 
        'number', 'city','zipcode', 
        'ip_address', 'contest_id', 'email', 
        'password', 'photo_path'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasPhotos() {
        return $this
            ->hasMany('App\ContestPhotos', 'user_id');
    }

    public function hasInvite() {
        return $this
            ->hasOne('App\Invite', 'user_id');
    }
}
