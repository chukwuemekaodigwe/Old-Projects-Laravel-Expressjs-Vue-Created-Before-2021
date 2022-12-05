<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class questions extends Model
{
    use softDeletes;

    protected $fillable = [
        'question_no',
        'subject',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answer',
        'examyear',
        'examtype'
    ];

    protected $dates = ['deleted_at'];
}
