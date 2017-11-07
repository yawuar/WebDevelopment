<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ContestPhotos extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'contest_photos_id';
    protected $dates = ['deleted_at'];
    protected $table = 'contest_photos';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_path', 'title', 'content', 'user_id', 'likes',
        'superlikes', 'contest_id'
    ];

    public function votes() {
        return $this
            ->hasMany('App\Vote', 'contest_photos_id');
    }

    public function user() {
        return $this
            ->belongsTo('App\User', 'user_id')
            ->get()
            ->first();
    }
}
