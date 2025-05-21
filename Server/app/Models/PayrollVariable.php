<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollVariable extends Model
{
    /** @use HasFactory<\Database\Factories\PayrollVariableFactory> */
    use HasFactory;


    protected $fillable = [
        'position',
        'transport_allowance',
        'position_allowance',
    ];
}
