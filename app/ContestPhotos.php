<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContestPhotos extends Model
{
    use SoftDeletes;
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
}
