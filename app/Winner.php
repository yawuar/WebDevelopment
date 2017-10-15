<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'winners';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'contest_photos_id'
    ];
}
