@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Modify Student Information</h1>
    <a href="/dash/students/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-graduation-cap fa-sm text-white-50"></i> Students</a>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{!! !isset($student) ? '<i class="fa fa-plus fa-2x"></i> Register New Student ' : '<i class="fa fa-edit fa-2x"></i> Modify Student Info' !!}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-horizontal form-material" method="post" action="/dash/students/edit/{{$student->id}}
                ">
                <input type="hidden"  name="reg" value="admin" />
                   {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="{{ 'name' }}"
                                class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('full_name')))) }}</label>

                            <div class="col-md-10">

                                <input id="{{ 'name' }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="{{ 'name' }}"
                                    value="{{ $student->name }}" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="{{ 'phone_no' }}"
                                class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('phone_no')))) }}</label>

                            <div class="col-md-10">

                                <input id="{{ 'phone_no' }}" type="{{ isset($type) ? $type : 'text' }}"
                                    class="form-control @error('phone_no') is-invalid @enderror" name="{{ 'phone_no' }}"
                                    value="{{ $student->phone_no }}" required autocomplete="{{ 'phone_no' }}"">

                            @error('phone_no')
                            <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="{{ 'email' }}"
                                class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('email_address')))) }}</label>

                            <div class="col-md-10">

                                <input id="{{ 'email' }}" type="{{ 'email' }}"
                                    class="form-control @error('email') is-invalid @enderror" name="{{ 'email' }}"
                                    value="{{ $student['email'] }}" required autocomplete="{{ 'email' }}"">

                            @error('email')
                            <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-md-12">
                            <label for="{{ 'exam' }}"
                                class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('exam type')))) }}
                            </label>

                            <div class="col-md-12 d-flex justify-content-around">
                                <div class="switch-wrap d-flex justify-content-around">
                                    <p> WAEC</p>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[1]" name="exam[]" value="1">
                                        <label for="confirm-checkbox[1]"></label>
                                    </div>
                                </div>

                                <div class="switch-wrap d-flex justify-content-around">
                                    <p> NECO</p>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[2]" name="exam[]" value="2">
                                        <label for="confirm-checkbox[2]"></label>
                                    </div>
                                </div>

                                <div class="switch-wrap d-flex justify-content-around">
                                    <p> JAMB</p>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[3]" name="exam[]" value="3">
                                        <label for="confirm-checkbox[3]"></label>
                                    </div>
                                </div>

                                <div class="switch-wrap d-flex justify-content-around">
                                    <p> POST-UTME </p>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[4]" name="exam[]" value="4">
                                        <label for="confirm-checkbox[4]"></label>
                                    </div>
                                </div>

                                @error('exam[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="form-group row mb-0 mr-5">
                        <div class="col-md-offset-2 col-md-5">
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                name="req">
                                {{ __(strtoupper('Register')) }}
                            </button>
                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>
@endsection

