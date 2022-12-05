@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Photo Speaks :: {{ucwords($name)}} </h1>
    <div class="d-none d-sm-inline-block dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars fa-sm fa-fw text-blue-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/dash/testimonies/new"> Add New </a>
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
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-photo"></i> {{ucwords($name)}} Pictures </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body d-flex flex-row align-items-center justify-content-around"
            style="flex-wrap: wrap!important;">
            @foreach($testimonies as $testimony)
            <div class="testimony_wrapper">
                <div class="img_div">
                    <img src="{{asset($testimony->path)}}" alt="{{ $testimony->title }}"  />
                    <span> {{ ucwords($testimony->title) }}</span>
                </div>
                <div class="overlay" title="{{ $testimony->writeup }}">
                    <span class="options">
                        <form method="post" action="{{url('/dash/testimonies/'.$testimony->id)}}"
                            class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('delete')}}
                            <button type="button" class="btn btn-link"
                                onclick="return window.location='/dash/testimonies/{{$testimony->id}}/edit';">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button type="submit" class="btn btn-link">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                    </span>
                </div>
            </div>
            @endforeach
            <style>
            .testimony_wrapper {
                height: 250px;
                width: 230px;
                margin: 5px;
                box-shadow: 0px 0px 10px #0005;

            }

            .testimony_wrapper .img_div {
                height: inherit;
                width: inherit;

            }

            .testimony_wrapper img {
                height: 200px;
                width: inherit;
            }

            .testimony_wrapper .img_div span {
                display: block;
                background-color: rgba(0, 0, 0, 1);
                padding: 20px;
                width: inherit;
                margin-top: -10px;
                text-align: center;
                z-index: 2;


            }

            .testimony_wrapper div.overlay {

                background: rgba(200, 200, 200, .1);
                position: absolute;
                width: inherit;
                height: inherit;
                margin-top: -250px;
                transition: all 1s ease-in-out;
                z-index: 10000;
            }

            .testimony_wrapper div.overlay .options button {
                transition: all 1s ease-in-out;
                display: none;
                border-right: 1px #ccc;

            }

            .testimony_wrapper div.overlay:hover {
                background: rgba(10, 10, 10, .4);
            }

            .testimony_wrapper div.overlay:hover .options button {
                display: inline;
                color: #fff;
                
            }

            .testimony_wrapper .options {
                position: absolute;
                top: 0;
                right: 0;
                z-index: 20000;
                background: #000a;
                transition: all 1s ease-in-out;
            }

            </style>
            {{$testimonies->links()}}
        </div>
    </div>
</div>

@endsection