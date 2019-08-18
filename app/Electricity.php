<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
   protected $fillable = [
     'user_id',
     'transaction_id',
     'reference',
     'account',
     'service_type',
     'amount'
   ];

   public function user(){
       return $this->belongsTo(User::class,'user_id','id');
   }
}
