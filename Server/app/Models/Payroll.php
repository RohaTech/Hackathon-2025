<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    /** @use HasFactory<\Database\Factories\PayrollFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'working_days',
        'earned_salary',
        'allowances',
        'other_commissions',
        'gross_pay',
        'taxable_income',
        'income_tax',
        'employee_pension',
        'employer_pension',
        'loan_or_penality',
        'total_deductions',
        'net_pay',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
