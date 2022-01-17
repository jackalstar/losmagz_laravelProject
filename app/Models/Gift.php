<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'gifts';
    protected $fillable = ['name', 'cost_minute', 'receive_minute', 'image'];
}

