<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use softDeletes;

    protected $fillable = [
        'title', 'url', 'body', 'category_id', 'writer_name', 'status', 'summary', 'tags', 'publish_date',
    ];
    
    protected $dates = ['deleted_at'];


    /**
     * Adding relationships to models; this will help us access the properties
     * of that other model from here
     */

     public function category(){
         return $this->belongsTo('App\Category');
     }

     public function comments(){
         return $this->hasMany('App\Comment');
     }

     public function getRouteKeyName(){
         return 'url';
     }
}
