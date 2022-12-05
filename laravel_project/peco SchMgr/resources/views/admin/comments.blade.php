@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Recent Comments</h1>
    <div class="d-none d-sm-inline-block dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars fa-sm fa-fw text-blue-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/dash/comments/read/all"> Mark All as Read</a>
            <a class="dropdown-item" href="/dash/comments/unread/all"> Mark All as Unread</a>

        </div>
    </div>

</div>
@include('includes.feedback')
@empty($comments) <p>No new comments found</p> @endempty
<div class="accordion" id="myAccordion">

    @foreach($comments as $comment)

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
            id="{{ 'heading'.$comment->id }}">
            <h6 class="mb-0">
            Blog Title:  {{ ucwords($comment->blog['title']) }}  {!!$comment->status!!}
            </h6>

            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Other Options</div>
                    <a class="dropdown-item" href="/dash/students/all">Active Students</a>
                    <a class="dropdown-item" href="/dash/students/acc_code"> Get Access Code</a>

                </div>
            </div>
        </div>

        <div class="card-body flex-row align-items-center justify-content-between">

            <div class="col-12 col-md-12">
                <span><strong> {{ $comment->guest_name}} &nbsp; | &nbsp;
                        ({{$comment->guest_email}})</strong> writes: </span>
                <span style="float: right">
                    <form method="post" action="{{url('/dash/comments/'.$comment->id)}}" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('delete')}}



                        <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="{{ '#collapse'.$comment->id }}"><i class="fa fa-reply"></i>
                            Reply
                        </button>
                        <button type="submit" class="btn btn-link">
                            <i class="fa fa-trash-alt"></i> Hide
                        </button>
                    </form>
                </span>
            </div>
            <div class="col-md-12 col-12">

                <blockquote style="font-family:'brush script mt' ; font-size: 1.2em;">
                    {{ $comment->body }}</blockquote>

            </div>
        </div>

        <div id="{{ 'collapse'.$comment->id }}" class="collapse col-md-12 "
            style="margin: 0px auto; background-color: #eeea; transition: all .6s 0s ease-in-out; padding: 20px;"
            aria-labelledby="{{ 'heading'.$comment->id }}" data-parent="#myAccordion">

            <form method="post" id="reply" action="{{url('/dash/comments/'.$comment->id)}}" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('patch')}}
                <div class="form-group row">
                    <div class="col-md-12" style="margin:0 auto">

                        <textarea id="reply" style="min-height:20px!important;"
                            class="form-control @error('reply') is-invalid @enderror" name="{{ 'reply' }}"
                            autocomplete="{{ 'reply' }}" "> {!! old('reply') !!}</textarea>


                                        @error('reply')
                                        <span class=" invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row" style="margin: 0 auto;">
                                    <div class="">

                                        <button type="submit"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" name="req"
                                            value="pub">
                                            {{ __(('Publish')) }}
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

        @endforeach

        {{ $comments->links() }}
    </div>

@endsection