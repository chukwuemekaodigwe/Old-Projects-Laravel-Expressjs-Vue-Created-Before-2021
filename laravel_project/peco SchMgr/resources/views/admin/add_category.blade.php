@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Blog Category</h1>
    <a href="/dash/categories/index" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-edit fa-sm text-white-50"></i> All Categories</a>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-plus fa-2x"></i> New Blog Category </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-horizontal form-material" method="post" action="/dash/categories/store">
                
                   {{ csrf_field() }}
                   
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="{{ 'name' }}"
                                class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('name')))) }}</label>

                            <div class="col-md-12">

                                <input id="{{ 'name' }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="{{ 'name' }}"
                                    value="{{ old('name') }}" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                
                        <div class="form-group col-md-12">
                            <label for="{{ 'desc' }}"
                                class="col-md-8 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('category_description')))) }}</label>

                            <div class="col-md-12">
<textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" value="{{ old('desc') }}" required></textarea>

                            @error('desc')
                            <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row mb-0 mr-5">
                        <div class="col-md-offset-2 col-md-5">
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                name="req">
                                {{ __(strtoupper('Create')) }}
                            </button>
                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>
@endsection

