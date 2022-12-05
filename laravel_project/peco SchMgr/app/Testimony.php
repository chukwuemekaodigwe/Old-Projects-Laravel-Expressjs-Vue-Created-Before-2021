<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimony extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'path', 'type', 'status', 'writeup'];

    protected $dates = ['deleted_at'];

}
