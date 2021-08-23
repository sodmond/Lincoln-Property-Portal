<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'email', 'gender', 'dob', 'phone', 'state', 'country',
        'ref_code', 'acct_name', 'bank_name', 'acct_num', 'ref_by', 'created_at',
    ];
}
