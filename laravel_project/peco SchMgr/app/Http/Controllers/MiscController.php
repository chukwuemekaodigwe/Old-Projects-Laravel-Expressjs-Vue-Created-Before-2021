<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscController extends Controller
{
    //
    public static function addInputField($name, $type='', $upd_info=''){
        $type = !empty($type) ? $type : 'text';
        $value = !empty($upd_info) ? $upd_info : '';

        echo '
<div class="form-group row">
    <label for="{{ '.$name.' }}"
        class="col-md-2 col-form-label text-md-right">{{ __('.ucwords(str_replace("_", " " , ($name))).') }}</label>

    <div class="col-md-10">

        <input id="{{ '.$name.' }}" type="'.$type.'" class="form-control @error('.$name.') is-invalid @enderror" name="{{ '.$name.' }}"
            value="'.$value.'.old('.$name.') " required autocomplete="{{ '.$name.' }}" autofocus>


        @error('.$name.')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
';

    }

    protected function addTextArea($name, $wt_editor='', $upd_info=''){
        $id = !empty($upd_info) ? 'editor' : $name;
        $value = !empty($upd_info) ? $upd_info : '';

        return '
        <div class="form-group row">
                            <label for="{{ '.$name.' }}" class="col-md-2 col-form-label text-md-right">{{ __('.ucwords(str_replace("_", " " , ($name))).') }}</label>
                            <div class="col-md-10">

                                <textarea id="{{ '.$id.' }}" class="form-control @error('.$name.') is-invalid @enderror" name="{{ '.$name.' }}" value="'.$value.'{{ old('.$name.') }}" required autocomplete="{{ '.$name.' }}"></textarea>
                                
                                @error('.$name.')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
        
        ';
    }
}