<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyPhoto extends Model
{
    use HasFactory;
    protected $table = 'verify_photos';
    protected $fillable = ['user_id','photo_name1', 'photo_name2', 'photo_name3'];
}
