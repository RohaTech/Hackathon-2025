<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory, Notifiable,  HasApiTokens;

    protected $fillable = [
        'name',
        'gender',
        "email",
        'employement_type',
        "position",
        "employement_date",
        "basic_salary",
        "bank_account_id"
    ];

    public function account() : HasOne
    {
        return $this->hasOne(Account::class,'id');
    }
}
