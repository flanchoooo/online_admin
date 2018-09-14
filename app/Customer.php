<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'users';
    protected $hidden = [
        'password', 'remember_token','token','created_at','updated_at','verified','status'
    ];

}
