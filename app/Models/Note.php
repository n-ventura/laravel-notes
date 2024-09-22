<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    public function user(){
        //este modelo pertence a User
        return $this->belongsTo(User::class);
    }
}
