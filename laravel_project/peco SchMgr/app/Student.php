<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'phone_no', 'exam', 'status', 'session'];

    public function getExamAttribute($value){
        $names = array('waec', 'neco', 'utme', 'post utme');
        $value = explode(';', $value);
        
        if(is_array($value)){
            foreach($value as $key){
                $exam[] = $names[($key-1)];
            }
            $exam = implode(', ', $exam);
        }else{
            $exam = $names[($value-1)];
        }
        
        return strtoupper($exam);
    }

    public function getStatusAttribute($value){
        $st_names = array('pending', 'active', 'suspended');
        return strtoupper($st_names[$value]);
    }

/**
 * Overriding the default find() method 
 * in order to useother fields for the search
 */
    public static function find($item, $columns = ['*']){
        $model = static::query()->find($item, $columns);

        return $model;
    }
    
}