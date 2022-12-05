@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">New Blog Post</h1>
    <a href="/dash/blogs/drafts" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-disk fa-sm text-white-90"></i>  View Drafts</a>
</div>
@include('includes.feedback')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> Create Blog Post</h6>
                <div style="float: right; margin-righht: 10px;"><button type="button" class="btn btn-link btn-sm" onclick="return window.location='/dash/categories/create?rd=post';"> <i class="fas fa-plus"></i> Add Category</button></div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-material" method="post" action="/dash/blogs/add
               " enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="{{ 'title' }}"
                            class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('title')))) }}</label>

                        <div class="col-md-12">

                            <input id="{{ 'title' }}" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="{{ 'title' }}"
                                value="{{ old('title') }}" required autocomplete="{{ 'title' }}"
                                placeholder="Enter a descriptive title of the post">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="{{ 'categ' }}" class="col-md-5 col-form-label text-md-left"
                            title="category of post">{{ __(ucwords(str_replace('_', ' ', ('category')))) }}</label>
                        <div class="col-md-12">

                           <select name="categ" id="categ" 
                                class="form-control @error('categ') is-invalid @enderror" required > 
<option value="" acceskey=""> Select a Category </option>
@foreach($categories as $category)
<option value="{{ $category->id }}" acceskey="{{ substr(($category->name), 0, 1) }}"> {{ $category->name }} </option>
@endforeach
                                </select>

                            @error('categ')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                        
                    </div>
</div>
                    <div class="form-group row">
                        <label for="{{ 'body' }}"
                            class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('body')))) }}</label>
                        <div class="col-md-12">

                            <textarea id="editor" style="min-height:200px!important"
                                class="form-control @error('body') is-invalid @enderror" name="{{ 'body' }}"
                                value="{{ old('body') }}" autocomplete="{{ 'body' }}"></textarea>


                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="{{ 'summary' }}" class="col-md-5 col-form-label text-md-left"
                            title="Give a detailed summary of the post. Highlighting the main contents of the post. IN 70 WORDS ">{{ __(ucwords(str_replace('_', ' ', ('summary')))) }}</label>
                        <div class="col-md-12">

                            <textarea id="summary" style="min-height:100px!important" maxlength="120"
                                class="form-control @error('summary') is-invalid @enderror" name="{{ 'summary' }}"
                                required autocomplete="{{ 'summary' }}"
                                
                                title="Give a detailed summary of the post. Highlighting the main contents of the post. IN 70 WORDS "></textarea>


                            @error('summary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="{{ 'tegs' }}" class="col-md-5 col-form-label text-md-left"
                            title="Keywords either used/relating to this post">{{ __(ucwords(str_replace('_', ' ', ('tags')))) }}</label>
                        <div class="col-md-12">

                            <textarea id="tags" style="min-height:50px!important"
                                class="form-control @error('tags') is-invalid @enderror" name="{{ 'tags' }}"
                                required autocomplete="{{ 'tags' }}"
                                onfocus="this.value=''"
                                title="Keywords either used/relating to this post"> Keywords either used/relating to this post separated by comma</textarea>


                            @error('summary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
<div class="row">
                    <div class="form-group col-md-6">
                        <label for="{{ 'image' }}"
                            title="An image to show as a highlight image" class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('Header Image')))) }}</label>

                        <div class="col-md-12">

                            <input id="{{ 'image' }}" type="file" title="An image to show as a highlight image not more than 30KB"
                                 @error('image') is-invalid @enderror" name="{{ 'image' }}"
                                value="{{ old('image') }}" required accept="image/jpeg">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="{{ 'writer_name' }}"
                            class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ("writer's_name")))) }}</label>

                        <div class="col-md-12">

                            <input id="{{ 'writer_name' }}" type="{{ isset($type) ? $type : 'text' }}"
                                class="form-control @error('writer_name') is-invalid @enderror"
                                name="{{ 'writer_name' }}" value="{{ old('writer_name') }}" required
                                autocomplete="{{ 'writer_name' }}" placeholder="The author of the post">

                            @error('writer_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

</div>
                    <div class="form-group row" style="margin: 0 auto;">
                        <div class="">
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="req" value="draft"
                                style="">
                                {{ __(('Save as Draft')) }}
                            </button>

                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" name="req" value="pub"
                                >
                                {{ __(('Publish')) }}
                            </button>
                        </div>

                    </div>

            </div>
            </form>

        </div>
    </div>
</div>

@endsection

