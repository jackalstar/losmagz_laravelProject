<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'messages';
    protected $fillable = ['from_email', 'to_email', 'message_source','message_source','message_trans', 'read_state', 'clear_by'];
}

