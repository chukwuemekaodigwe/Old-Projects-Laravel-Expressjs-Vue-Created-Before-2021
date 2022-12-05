@extends('layouts.app')

@section('content')

<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-9 col-md-12">
                <h1 class="text-uppercase">
                    We give the Best
                </h1>
                <h4 class="pt-10 pb-10" style="color: #fff; font-style: italic">
                    SSCE exams and preparations are made easier and simpler! <br>You're assured of your excellent
                    results and success!!!
                </h4>
                <div class="col-md-6" style="marggin: 0 auto;">
                    @include('includes.feedback')
                </div>
                <br><br>
                <a href="#reg" class="primary-btn text-uppercase"> Try Us Today</a>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start feature Area -->
<section class="feature-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4> Latest Update</h4>
                    </div>
                    <div class="desc-wrap">
                        <ul style="list-style-type: square; text-align: left; color: blue;">
                            @if(!empty($announcement) && count($announcement) > 0)
                            {{dd($announcement)}}
                            @foreach($announcement as $value)
                            <li>
                                <button type="" class="updModal btn btn-link text-italic"
                                    data-title="{!!$value->title!!}" data-body="{!!$value->body!!}"
                                    data-source="{!!$value->source!!}" style="font-size: 1.3em; font-weight: lighter;">
                                    {!! ucwords($value->title) !!}<br>
                                </button>
                            </li>
                            @endforeach
                            @else
                            <h4><i>
                                    Ooh, no updates at the moment!
                                </i></h4>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4> Quote of the Day</h4>
                    </div>
                    <div class="desc-wrap">
                        @if(!empty($quote))
                        <h4> {{ strtoupper($quote->title) }} </h4>
                        <hr>
                        <blockquote> {!! $quote->body !!} </blockquote>
                        <span style="font-style: italic; text-align: right;"> <b>By:</b> {{$quote->author}} </span>
                        @else
                        <h4><i> No recent quotes found!</i></h4>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4> Latest Post</h4>
                    </div>
                    <div class="desc-wrap">
                        @if(!empty($blog) && count($blog) > 0)
                        <h4> Theme: {{ strtoupper($blog[0]->title )}} </h4>
                        <hr>
                        <span>
                            {!! $blog[0]->summary!!}
                        </span>
                        <a href="/blogs/{{$blog[0]->category->name}}/{{ $blog[0]->url }}"
                            style="font-style: italic; color: blue;"> Continue >> </a> |
                        <a href="/blogs/" style="font-style: italic; color: blue;"> View more </a>
                        @else
                        <h4><i> No Recent Blogs Found!</i></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End feature Area -->
<style>
.thumb img {
    max-height: 200px;
}
</style>
<!-- Start popular-course Area -->
<section class="popular-course-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Popular @ <br>
                        <span style="font-size: .7em;">Pacesetters Educational Center, Onitsha
                    </h1>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="active-popular-carusel">
                <div class="single-popular-carusel">
                    <div class="thumb-wrap relative">
                        <div class="thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="img/b3.jpg" alt="">
                        </div>
                        <div class="meta d-flex justify-content-between">

                            <h4><i class="fa fa-tick"></i></h4>
                        </div>
                    </div>
                    <div class="details">
                        <a href="#">
                            <h4>
                                CBT Practising
                            </h4>
                        </a>
                        <span>
                            You can always practise <b>here</b> on your exam using our Computer-Based Quiz system which
                            is made up of the recent past questions of that examination.
                        </span>
                        <div class="text-center">
                            <a href="/quiz" class="primary-btn text-uppercase"> Start Now</a>
                        </div>
                    </div>
                </div>
                <div class="single-popular-carusel">
                    <div class="thumb-wrap relative">
                        <div class="thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="img/cta-bg.jpg" alt="waec discussion class"
                                style="height:600px;">
                        </div>
                        <div class="meta d-flex justify-content-between">

                            <h4><i class="fa fa-tick"></i></h4>
                        </div>
                    </div>
                    <div class="details">
                        <a href="#">
                            <h4>
                                SSCE / JAMB Preparatory Classes
                            </h4>
                        </a>
                        <span>
                            We have preparatory classes for JAMB, WAEC, NECO, POST-UTME exams. We have experienced
                            tutors who will get you prepared for your SSCE exams. Join the winning team to ensure your
                            success.
                        </span>
                        <div class="text-center">
                            <a href="#reg" class="primary-btn text-uppercase"> Join Now</a>
                        </div>
                    </div>
                </div>
                <div class="single-popular-carusel">
                    <div class="thumb-wrap relative">
                        <div class="thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="img/peco2.jpg" alt="">
                        </div>
                        <div class="meta d-flex justify-content-between">

                            <h4><i class="fa fa-tick"></i></h4>
                        </div>
                    </div>
                    <div class="details">
                        <a href="#">
                            <h4>
                                Exam Runz
                            </h4>
                        </a>
                        <span>
                            The taste of the pudding is in the eating. You are assured of an excellent result. Our
                            students results are testimonials to this.
                        </span>
                        <div class="text-center">
                            <a href="/testimony" class="primary-btn text-uppercase"> Evidences</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End popular-course Area -->


<!-- Start search-course Area -->
<section class="search-course-area relative" id="reg">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-6 search-course-left" style="margin: 35px 0">
                <h1 class="text-white" style="text-transform: capitalize">
                    Get reduced <br> fees this session!
                </h1>
                <span>
                    We are distinguished from other tutorial centers and schools by the following:
                </span>
                <div class="row details-content">
                    <div class="col single-detials">
                        <span class="lnr lnr-graduation-hat"></span>
                        <a href="#">
                            <h4>Expert Instructors</h4>
                        </a>
                        <p>
                            Our team of experienced teachers gives you a guarantee of a huge success
                        </p>
                    </div>

                    <div class="col single-detials">
                        <span class="lnr lnr-graduation-hat"></span>
                        <a href="#">
                            <h4>Excellent Outcomes</h4>
                        </a>
                        <p>
                            The minimum JAMB score of our students is always above 250. They make their results in one
                            sitting. These are result of a experienced and expert management.
                        </p>
                    </div>
                </div>
                <div class="row details-content">
                    <div class="col single-detials">
                        <span class="lnr lnr-license"></span>
                        <a href="#">
                            <h4>Certification</h4>
                        </a>
                        <p>
                            You are assured of your certifiacates within two years of your examination
                        </p>
                    </div>

                    <div class="col single-detials">
                        <span class="lnr lnr-graduation-hat"></span>
                        <a href="#">
                            <h4>Easily Accessible</h4>
                        </a>
                        <p>
                            We offer our students a more easier methods of interacting with their instructors and
                            managers.
                        </p>
                    </div>

                </div>

            </div>

            <div class="col-lg-4 col-md-6 search-course-right section-gap">

                <form class="form-wrap" action="/students/new" method="post">
                    {{csrf_field() }}
                    <h4 class="text-white pb-20 text-center mb-30">Get Started </h4>
                    <input type="text" class="form-control" name="name" placeholder="Your Name"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Name'" required>
                    <input type="phone" class="form-control" name="phone_no" placeholder="Your Phone Number"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Phone Number'" required>
                    <input type="email" class="form-control" name="email" placeholder="Your Email Address"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'" required>

                    <div class="form-select" style="margin-top: 5px;">
                        <select name="session">>
                            <option default="" value="0">Choose Exam Year</option>
                            <?php
$now = date('Y', strtotime('today'));
$last = $now + 3;
?>

                            @for ($i = ($now - 1); $i <= $last; $i++) <option value="{{ $i }}">
                                {{ $i }}
                                </option>
                                @endfor


                        </select>
                    </div>

                    <div class="row">
                        <div class="form-group" style="
width: 100%;
margin-left: 11px;
color: #fffa;

box-sizing: border-box;
">
                            <style>
                            li.switch-wrap {
                                display: block !important;
                                list-style: none;
                            }
                            </style>
                            <label for="{{ 'exam' }}"
                                class="col-md-5 col-form-label text-md-left">{{ __(ucwords(str_replace('_', ' ', ('exam type')))) }}
                            </label>

                            <div class="col-md-12 " style="margin-righht: 10px;">
                                <li class="switch-wrap">
                                    <span> WAEC</span>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[1]" name="exam[]" value="1">
                                        <label for="confirm-checkbox[1]"></label>
                                    </div>
                                </li>

                                <li class="switch-wrap">
                                    <span> NECO</span>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[2]" name="exam[]" value="2">
                                        <label for="confirm-checkbox[2]"></label>
                                    </div>
                                </li>

                                <li class="switch-wrap">
                                    <span> JAMB</span>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[3]" name="exam[]" value="3">
                                        <label for="confirm-checkbox[3]"></label>
                                    </div>
                                </li>

                                <li class="switch-wrap">
                                    <span> POST-UTME </span>
                                    <div class="confirm-checkbox">
                                        <input type="checkbox" id="confirm-checkbox[4]" name="exam[]" value="4">
                                        <label for="confirm-checkbox[4]"></label>
                                    </div>
                                </li>

                                @error('exam.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <button class="primary-btn text-uppercase">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End search-course Area -->



<!-- Start blog Area -->
@if(!empty($blog))
<section class="blog-area section-gap" id="blog">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Latest posts from our Blog</h1>

                </div>
            </div>
        </div>
        <div class="row">
            
            @foreach($blog as $value)
            <div class="col-lg-3 col-md-6 single-blog">
                <div class="thumb">
                    <img class="img-fluid" src="{{asset('/img/header/'.$value->url.'.jpeg')}}" alt="{{$value->title}}">
                </div>
                <span class="meta"> {{date('d M, Y', strtotime($value->publish_date))}} | By <a href="#">
                        {{ucwords($value->writer_name) }}</a></span>
                <a href="{{url('/blogs/'.$value->url)}}">
                    <h5>{{ucwords($value->title)}}</h5>
                </a>
                {!! ucwords($value->summary) !!}
                <a href="{{url('/blogs/'.$value->category->name.'/'.$value->url)}}"
                    class="details-btn d-flex justify-content-center align-items-center"><span
                        class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
            </div>
            @endforeach
            @endif

        </div>
    </div>
</section>
<!-- End blog Area -->


<!-- Start review Area -->
<section class="review-area section-gap relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10"> Recent Comments</h1>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="active-review-carusel">
                @if(!empty($comments))
                @foreach($comments as $comment)

                <div class="single-review item">
                    <div class="title justify-content-start d-flex">
                        <a href="#">
                            <h4> {{ucwords($comment->guest_name)}} </h4>
                        </a>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <span> Comments on <b>{{ucwords($comment->blog['title']) }}</b> Blog: </span>
                    <span style="font-style:italic">
                        {{$comment->body}}
                    </span>
                </div>

                @endforeach
                @endif

            </div>
        </div>
    </div>
</section>
<!-- End review Area -->



<!-- Start upcoming-event Area -->
<section class="upcoming-event-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Recent Events of Our Institution </h1>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="active-upcoming-event-carusel">
                @if(!empty($event))
                @foreach($event as $value)

                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset($value->path)}}" alt="{{$value->title}}">
                    </div>
                    <div class="detials col-12 col-md-6">

                        <a href="#">
                            <h4> {{ucwords($value->title)}}</h4>
                        </a>
                        <span>
                            {!! $value->writeup!!}
                        </span>
                    </div>
                </div>

                @endforeach
                @endif

            </div>
        </div>
    </div>
</section>
<!-- End upcoming-event Area -->


@endsection