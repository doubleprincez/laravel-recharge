<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null|string subscriber_id
 * @property mixed type
 * @property mixed service_id
 * @property mixed service_code
 * @property mixed transaction_id
 * @property mixed reference
 * @property mixed amount
 * @property string status
 * @property mixed paid_at
 */
class Transaction extends Model
{
    protected $fillable = [
        'subscriber_id',
        'transaction_id',
        'reference',
        'type',
        'amount',
        'service_id',
        'service_code',
        'status',
        'paid_at'
    ];
}
