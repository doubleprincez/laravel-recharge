<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property mixed installment
 * @property mixed amount
 * @property mixed balance
 * @property mixed total
 * @property mixed customer_code
 * @property mixed reference
 * @property mixed transaction_id
 * @property mixed status
 * @property mixed paid_at
 */
class Activation extends Model
{
   protected $fillable = [
     'user_id',
     'installment',
     'amount',
     'balance',
     'total',
     'customer_code',
     'reference',
     'transaction_id',
     'status',
     'paid_at'
   ];
}
