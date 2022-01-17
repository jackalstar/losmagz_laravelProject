<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptureVideo extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'captured_video';
    protected $fillable = ['video'];
}

