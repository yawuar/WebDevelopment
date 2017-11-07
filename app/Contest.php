<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contest extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'contests';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'photo_path', 'starting_date', 'ending_date', 'is_active', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id')->get()->first();
    }
}
