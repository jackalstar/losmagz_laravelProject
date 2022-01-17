<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveLike extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'give_like';
    protected $fillable = ['man_email', 'woman_email'];
}

