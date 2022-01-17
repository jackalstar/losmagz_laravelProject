<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'withdraws';
    protected $fillable = ['username', 'email', 'withdrawpoints', 'paymethod','card_name', 'card_number', 'card_cvc', 'expiration_month', 'expiration_year'];
}

