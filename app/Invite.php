<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';
    public $timestamps = true;

    protected $fillable = [
        'email', 'user_id', 'isValidated', 'hasExtraPoints'
    ];
}
