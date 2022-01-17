<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapturePhoto extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'captured_photo';
    protected $fillable = ['image'];
}

