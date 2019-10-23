<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    protected $fillable = [
        'name', 'address', 'phone', 'store_id', 'salary', 'join_date', 'last_salary', 'outlet_id', 'created_by'
    ];


    protected $casts = [
        'salary' => 'double'
    ];
}
