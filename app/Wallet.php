<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed owner_id
 * @property mixed wallet_balance
 * @property mixed card_bonus
 * @property mixed travelling_bonus
 * @property mixed monthly_bonus
 * @property mixed festival_bonus
 */
class Wallet extends Model
{
    //
    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    }
}
