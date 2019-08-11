<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class,'owner_id','id');
    }
}
