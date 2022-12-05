@extends('layouts.admin')

@section('content')


    <h1 class="h3 mb-0 text-gray-800"> All Blog Post</h1>
    <p> This list comprises of all published blog posts </p>
    
@include('includes.feedback')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> All Blog Posts</h6>
                
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/dash/blogs/add"> Create New</a>
                        <a class="dropdown-item" href="/dash/blogs/drafts">View Drafts</a>

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
                                                <span style="display:inline; font-style: italic"> Post Url: {{ ($quote->url) }} &nbsp;&nbsp; | &nbsp;&nbsp;</span>
                                                
                                                <span style="display:inline; font-style: italic"> Post Category: {{ $quote->category->name }} &nbsp;&nbsp; | &nbsp;&nbsp;</span>

                                                <span style="display:inline; font-style: italic"> Date Published: {{ date('d M, Y', strtotime($quote->publish_date)) }} </span>
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

