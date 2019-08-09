<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null|string user_id
 * @property string type
 * @property string  transaction_id
 * @property string  reference
 * @property string  service_id
 * @property string  service_type
 * @property mixed service_code
 * @property float amount
 */
class Pin extends Model
{

    protected $fillable = [
        'user_id',
        'type',
        'transaction_id',
        'reference',
        'service_id',
        'service_type',
        'service_code',
        'amount'
    ];
}
