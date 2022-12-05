@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> {{!isset($single) ? 'Drafts': $posts[0]->title }}</h1>
    <a href="/dash/blogs/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Create Post</a>
</div>
@include('includes.feedback')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> {{!isset($single) ? 'Unpublished Posts': $posts[0]->title }} </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="/dash/blogs/all">View Published</a>

                    </div>
                </div>

            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="accordion" id="myAccordion">
                        
                        @foreach($posts as $quote)
                        
                            <div class="card">
                                <div class="card-header" id="{{ 'heading'.$quote->id }}" style="cursor:pointer; display: inline; float:left" data-toggle="collapse" data-target="{{ '#collapse'.$quote->id }}">
                                    <div class="row">
                                    <div class="col-md-10 col-sm-10">
                                        <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h4 class="mb-0">
                                            <i class="fa fa-plus"></i> &nbsp;&nbsp;    {{ ucwords($quote->title) }}
                                            </h4>
                                        </div>
                                        <div class="col-md-12">
                                            <span style="display:inline; font-style: italic"> Created: {{ date('d M, Y', strtotime($quote->created_at)) }} &nbsp;&nbsp; | &nbsp;&nbsp;</span>
                                            
                                            <span style="display:inline; font-style: italic"> Last Updated: {{ date('d M, Y', strtotime($quote->updated_at)) }}</span>
                                        </div>
                                    </div>
</div>
                                    <div class="col-md-2 col-sm-2" style="margin-right: -5px;">
                                        <form method="post" action="{{url('dash/blogs/'.$quote->url)}}"
                                            class="form-horizontal">
                                            {{ csrf_field() }}
                                            {{ method_field('delete')}}

                                            <button type="button" class="btn btn-link"
                                                onclick="return window.location='/dash/blogs/{{$quote->url}}/edit';">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="submit" class="btn btn-link">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
</div>
                                <div id="{{ 'collapse'.$quote->id }}" class="collapse"
                                    aria-labelledby="{{ 'heading'.$quote->id }}" data-parent="#myAccordion">
                                    <div class="card-body">
                                        {!! $quote->body !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
</div>
            </div>
        </div>
    </div>

</div>
@endsection

