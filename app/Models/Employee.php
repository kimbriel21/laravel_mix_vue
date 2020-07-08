<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        "first_name",
        "middle_name",
        "last_name",
        "employee_id",
        "address",
        "birthday",
        "number",
    ];
}
