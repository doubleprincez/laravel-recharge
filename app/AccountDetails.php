<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  string bank
 * @property string account_type
 * @property  int account_number
 * @property int|null|string user_id
 */
class AccountDetails extends Model
{
    protected $fillable = [
        'bank',
        'user_id',
        'account_number',
        'account_type'
    ];
}
