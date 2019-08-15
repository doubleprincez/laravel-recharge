<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminlogin extends Model
{
  protected $fillable =[
    'fullname',
    'email',
    'phone',
    'password'
  ];
}
