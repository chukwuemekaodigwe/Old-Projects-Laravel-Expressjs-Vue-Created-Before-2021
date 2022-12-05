@extends('layouts.app')

@section('content')

    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Photo Speaks
                    </h1>
                    <p class="text-white link-nav">Seeing Is Believing!!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start gallery Area -->
    <section class="gallery-area section-gap">
        <div class="container">
            <div class="row">
                @foreach($testimonies as $testimony)

                <div class="col-lg-6" >
                    <a href="{{asset($testimony->path)}}" class="img-gal">
                        <div class="single-imgs relative">
                            <div class="overlay overlay-bg"></div>
                            <div class="relative">
                                <img class="img-fluid" src="{{asset($testimony->path)}}" alt="{{asset($testimony->title)}}" style="height:250px">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <!-- End gallery Area -->


@endsection
