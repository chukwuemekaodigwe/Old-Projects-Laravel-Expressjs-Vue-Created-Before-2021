<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment_Reply extends Model
{
    use Softdeletes;

    protected $fillable = ['comment_id', 'body'];
    protected $dates = ['deleted_at'];

    public function Comment()
    {
        return belongsTo('App\Comment');
    }
}
