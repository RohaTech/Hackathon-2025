<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Account extends Model
{
    use HasFactory, Notifiable,  HasApiTokens;
    protected $fillable = [
        'account_number',
        'balance',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
