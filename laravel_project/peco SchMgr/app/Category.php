<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use softDeletes;

    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Adding relationships to models; this will help us access the properties
     * of that other model from here
     */

     public function blogs(){
         return $this->hasMany('App\Blog');
     }

     public function getRouteKeyName(){
        return 'name';
    }
}
