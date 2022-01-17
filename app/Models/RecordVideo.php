<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordVideo extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'record_video';
    protected $fillable = ['title', 'video', 'self_email', 'self_username', 'vlength', 'timer', 'recommend'];
}

