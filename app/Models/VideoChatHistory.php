<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoChatHistory extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'videochathistories';
    protected $fillable = ['self_email', 'partner_email', 'self_username', 'partner_username','start_time', 'end_time', 'vlength'];
}

