<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     //ligação das relações user notes
     public function notes(){
        return $this->hasMany(Note::class);
    }
}
