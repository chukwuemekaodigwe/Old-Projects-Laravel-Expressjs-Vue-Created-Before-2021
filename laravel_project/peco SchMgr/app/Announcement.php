<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use softDeletes;
    
    protected $fillable = ['title', 'body', 'expiry', 'source'];

    protected $dates = ['deleted_at'];
    
    
}
