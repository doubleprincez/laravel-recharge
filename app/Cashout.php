<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cashout
 * @package App
 * @property int user_id
 * @property mixed amount
 * @property bool rejected
 * @property bool completed
 * @property string ref_id
 * @property int account_detail_id
 *
 */

class Cashout extends Model
{
  protected $fillable = [
      'ref_id',
      'account_detail_id',
      'user_id',
      'amount',
      'rejected',
      'completed'
  ];

  public function account(){
      return $this->belongsTo(AccountDetails::class,'account_detail_id','id');
  }

  public function user(){
      return $this->belongsTo(User::class,'user_id','id');
  }
}
