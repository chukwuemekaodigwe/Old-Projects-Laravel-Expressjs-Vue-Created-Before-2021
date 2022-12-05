<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'author', 'body', 'status'];

    protected $dates = ['deleted_at'];
    
    
}
