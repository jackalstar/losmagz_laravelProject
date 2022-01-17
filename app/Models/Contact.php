<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'contacts';
    protected $fillable = ['self_email','self_username', 'partner_email', 'partner_username', 'state', 'favourite', 'clear_by', 'block'];
}

