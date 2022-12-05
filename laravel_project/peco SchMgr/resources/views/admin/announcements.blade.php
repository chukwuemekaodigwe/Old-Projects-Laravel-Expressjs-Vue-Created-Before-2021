@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Recent Updates/Announcements</h1>
    <a href="/dash/announcement/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Add</a>
</div>
@include('includes.feedback')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> Recent News! (Latest 20 )</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
            <div class="accordion" id="myAccordion">
                        
                        @foreach($updates as $quote)
                        
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
                                            <span style="display:inline; font-style: italic"> Source: {{ ($quote->source) }} &nbsp;&nbsp; | &nbsp;&nbsp;</span>
                                            
                                            <span style="display:inline; font-style: italic"> Expiry Date: {{ date('d M, Y', strtotime($quote->expiry)) }}</span>
                                        </div>
                                    </div>
</div>
                                    <div class="col-md-2 col-sm-2" style="margin-right: -5px;">
                                        <form method="post" action="{{url('dash/announcement/'.$quote->id)}}"
                                            class="form-horizontal">
                                            {{ csrf_field() }}
                                            {{ method_field('delete')}}

                                            <button type="button" class="btn btn-link"
                                                onclick="return window.location='/dash/announcement/{{$quote->id}}/edit';">
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


                {{ $updates->links() }}
            </div>
        </div>
    </div>
</div>
</div>

@endsection
