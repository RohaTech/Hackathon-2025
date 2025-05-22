<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceValue extends Model
{
    /** @use HasFactory<\Database\Factories\AllowanceValueFactory> */
    use HasFactory;

    protected $fillable  = [
        "allowances_name",
        "ceo",
        "cto",
        "coo",
        "ciso",
        "director",
        "dept_lead",
        "normal_employee",
        "positioned",
        "non_positioned",
    ];
}
