<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use softDeletes;

    protected $fillable = ['guest_email', 'guest_name', 'blog_id', 'comment_id', 'type', 'status', 'body'];
    protected $dates = ['deleted_at'];

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    public function getStatusAttribute($value)
    {
        $values = array('new', 'read', 'replied');
        $color = array('red', 'purple', 'blue');
        return '<sub><i style="color:' . $color[$value - 1] . '; transform: rotate(-25deg);"> ' . $values[$value - 1] . ' </i></sub>';
    }

}
