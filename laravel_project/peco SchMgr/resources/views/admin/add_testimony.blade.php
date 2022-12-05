@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Photo Speaks:: Add New</h1>
    <div class="d-none d-sm-inline-block dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars fa-sm fa-fw text-blue-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/dash/testimonies/view/gallery"> Gallery Pictures</a>
            <a class="dropdown-item" href="/dash/testimonies/view/slide"> Slideshow Pictures</a>
            <a class="dropdown-item" href="/dash/testimonies/view/event"> Event Pictures</a>

        </div>
    </div>

</div>
@include('includes.feedback')
<div class="col-md-12">

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-plus"></i> Add Photo </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form class="form-horizontal form-material" method="post" action="/dash/testimonies/store"
                enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="input_wrapper">
                    <div class="row" id="pix1">
                        <div class="form-group col-md-6">
                            <label for="title" class="col-md-5 col-form-label text-md-left"> Image Caption </label>

                            <div class="col-md-12">

                                <input id="title" type="text" class="form-control @error(" title") is-invalid @enderror"
                                    name="title" value="{{ old("title") }}" required>

                                @error("title")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type" class="col-md-5 col-form-label text-md-left"> Pix Category </label>

                            <div class="col-md-12">
                                <select id="type" name="type" required="" class="form-control  custom-select @error("
                                    type") is-invalid @enderror">
                                    <option value="1"> Gallery Pix </option>
                                    <option value="2"> Slides Pix </option>
                                    <option value="3"> Events Pix </option>
                                </select>

                                @error("type")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="desc" class="col-md-8 col-form-label text-md-left"> Write Up </label>

                            <div class="col-md-12">
                                <textarea name="desc" id="desc" class="form-control @error(" desc") is-invalid
                                    @enderror"" rows="1" required>{{ old("desc") }}</textarea>

                                @error("desc")
                                <span class=" invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group col-md-6">
                            <label for="pix" class="col-md-8 col-form-label text-md-left"> Image </label>
                            <div class="col-md-12">
                                <input type="file" id="pix" accept="image/*" name="pix" class="" />
                                @error("pix")
                                <span class=" invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="filepath">
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group row mb-0 mr-5 submit">
                <div class="col-md-12 d-sm-flex align-items-center justify-content-between">
                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" name="req">
                        {{ __(('Submit')) }}
                    </button>

                    <!--   <button type="button" onclick="addBlock();"
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" name="req"
                        style="font-style: italic">
                        {{ __(ucwords('add another')) }}
                    </button>-->
                </div>

            </div>


            </form>

        </div>
    </div>

</div>

@endsection