<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user(){
        //este modelo pertence a User
        return $this->belongsTo(User::class);
    }
}
