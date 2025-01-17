<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    //public $timestamps = true;
    protected $table = 'languages';
    protected $fillable = ['lang_name', 'lang_code'];
}

