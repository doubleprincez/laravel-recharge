<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{

    protected $table ='recharges';

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }


}
