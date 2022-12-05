@extends('layouts.admin')

@section('content')

    <h1 class="h3 mb-1 text-gray-800"> Edit Existing Update</h1>



<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">  {{ $upd->title }} </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="form-horizontal form-material" method="POST" action="{{ url('/dash/announcement/'.$upd->id) }}" >
                {{csrf_field() }}
                {{ method_field('patch') }}
                    <div class="form-group row">
                        <label for="{{ 'title' }}"
                            class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ('title')))) }}</label>

                        <div class="col-md-10">

                            <input id="{{ 'title' }}" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="{{ 'title' }}"
                                value="{{ $upd->title }}" required autocomplete="{{ 'title' }}">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="{{ 'body' }}"
                            class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ('body')))) }}</label>
                        <div class="col-md-10">

                            <textarea id="editor" style="min-height:200px!important"
                                class="form-control @error('body') is-invalid @enderror" name="{{ 'body' }}"
                                required autocomplete="{{ 'body' }}">{!! $upd->body !!}</textarea>


                            @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="{{ 'source' }}"
                            class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ('source')))) }}</label>

                        <div class="col-md-10">

                            <input id="{{ 'source' }}" type="{{ isset($type) ? $type : 'text' }}"
                                class="form-control @error('source') is-invalid @enderror" name="{{ 'source' }}"
                                value="{{ $upd->source }}" required autocomplete="{{ 'source' }}"
                                placeholder="Name and website address  eg JAMB (www.jambonline.com)">

                            @error('source')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="{{ 'expiry' }}"
                            class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ('expiry date')))) }}</label>

                        <div class="col-md-10">

                            <input id="{{ 'expiry' }}" type="date"
                                class="form-control @error('expiry') is-invalid @enderror" name="{{ 'expiry' }}"
                                placeholder="yyyy/mm/dd" value="{{ $upd->expiry }}" required>


                            @error('expiry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="">
                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                name="req" style="">
                                {{ __(ucwords('republish')) }}
                            </button>
                        </div>

                    </div>

            </div>
            </form>

        </div>
    </div>
</div>

@endsection

