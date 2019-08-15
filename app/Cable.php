<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cable extends Model
{
    protected $table = 'cables';
    protected $fillable = [
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
