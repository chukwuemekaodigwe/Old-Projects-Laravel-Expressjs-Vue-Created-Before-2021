@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Students CBT Codes</h1>
    <a href="{{url('dash/students/')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-graduate fa-sm text-white-50"></i> All Students</a>
</div>

<div class="row">
    <div class="col-md-8" style="margin: 0 auto!important;">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> CBT Access Code</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Other Options</div>
                        <a class="dropdown-item" href="/dash/students/">Active Students</a>
                        <a class="dropdown-item" href="/dash/students/pending"> Prospective Students</a>

                    </div>
                </div>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-horizontal form-material" method="post" action="/dash/students/add
                ">
                    {{ __(csrf_field()) }}

                    <div class="form-group row">
                        <label for="{{ 'search' }}"
                            class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ('Search')))) }}</label>

                        <div class="col-md-10">

                            <input id="{{ 'search' }}" type="search" onkeyUp="search()"
                                class="form-control @error('search') is-invalid @enderror" name="{{ 'search' }}"
                                value="{{ old('search') }}" required
                                placeholder="Enter either the students' email address or phone number">

                            @error('search')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="">
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                name="req">
                                {{ __(strtoupper('Search')) }}
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

