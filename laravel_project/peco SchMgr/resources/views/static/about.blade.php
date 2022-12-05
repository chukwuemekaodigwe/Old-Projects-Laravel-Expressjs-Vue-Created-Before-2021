@extends('layouts\app')

@section('content')

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    About Us
                </h1>
                <p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span>
                    <a href="/about"> About Us</a></p>
                    @include('includes.feedback')
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
                            @if(!empty($announcement))
                            @foreach($announcement as $value)
                            <li>
                                <button type="" class="updModal btn btn-link text-italic"
                                    data-title="{!!$value->title!!}" data-body="{!!$value->body!!}"
                                    data-source="{!!$value->source!!}" style="font-size: 1.3em; font-weight: lighter;">
                                    {!! ucwords($value->title) !!}<br>
                                </button>
                            </li>
                            @endforeach
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
                        <h4> {{ strtoupper($quote->title) }} </h4>
                        <hr>
                        <blockquote> {!! $quote->body !!} </blockquote>
                        <p style="font-style: italic; text-align: right;"> <b>By:</b> {{$quote->author}} </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4> Latest Post</h4>
                    </div>
                    <div class="desc-wrap">
                        <h4> Theme: {{ strtoupper($blog[0]->title )}} </h4>
                        <hr>
                        <p>
                            {!! $blog[0]->summary!!}
                        </p>
                        <a href="/blogs/{{$blog[0]->category->name}}/{{ $blog[0]->url }}"
                            style="font-style: italic; color: blue;"> Continue >> </a> |
                        <a href="/blogs/" style="font-style: italic; color: blue;"> View more >></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End feature Area -->

<!-- Start info Area -->
<section class="info-area pb-120">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 no-padding info-area-left">
                <img class="img-fluid" src="img/about-img.jpg" alt="">
            </div>
            <div class="col-lg-6 info-area-right">
                <h2>Who we are</h2>

                <p>
                    Pacesetters Educational Centre, Onitsha - Anambra State Nigeria (PECO) was established in 2008 by
                    Mr. David C Okoro (B.Sc, M.Sc.) out of his love to impact knowlegde on the growing populace. Since
                    its inception, the institution had trained more than 3,000
                    students who excelled in their various examinations.
                </p>
                <br><br>
                <h2> Goals To Achieve</h2>

                <p>
                    We are here to ensure you achieve your dream of entering institution of higher learning in no
                    distance time. We are "The Nimble Entrance to University".

                </p>

            </div>
        </div>
    </div>
</section>
<!-- End info Area -->

<!-- Start course-mission Area -->
<section class="course-mission-area pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10"> Meet The Director</h1>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 accordion-left">
                <p>


                    The Director, Mr. David Chidi Okoro, obtained both his first (B.sc) and second (M.sc) degrees from
                    Nnamdi Azikiwe University (NAU), Awka in Anambra state, Nigeria. He is an exquisite teacher who
                    knows and loves teaching and had made many young people
                    love and embrace learning.
                </p>
                <p>
                    He has co-authored and reviewed many academic texts, journals and articles. He is a proven and
                    equipped tutor in numerous academic centres and schools within Onitsha and Awka metropolis prior to
                    the birth of Pacesetters Educational Centre, Onitsha.

                </p>
            </div>
            <div class="col-md-6 align-items-center d-flex relative">
                <div class="overlay overlay-bg"></div>
                <img src="img/pacessetters_director2.jpg" alt="pacessetters_educational_center_onitsha_director"
                    style="margin-top: -20px;" />
            </div>
        </div>
    </div>
</section>
<!-- End course-mission Area -->


<!-- Start search-course Area -->
<section class="search-course-area relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-6 search-course-left" style="margin: 35px 0">
                <h1 class="text-white">
                    Get reduced fee <br> during this Season!
                </h1>
                <p>
                    We are distinguished from other tutorial centers and schools by the following:
                </p>
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
                    <input type="phone" class="form-control" name="phone_no" placeholder="eg. +2348012345670"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Phone Number'" required>
                    <input type="email" class="form-control" name="email" placeholder="Your Email Address"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'" required>

                    <div class="form-select" id="service-select">
                        <select class="js-example-basic-multiple" name="exam[]" multiple="multiple">>
                            <option default="" selected>Choose Exam</option>
                            <option value="1"> WAEC</option>
                            <option value="2"> JAMB</option>
                            <option value="3"> POST UTME</option>
                            <option value="4"> NECO</option>
                        </select>
                    </div>
                    
                    <div class="form-select" style="margin-top: 5px;">
                        <select name="session">>
                            <option default="" value="0">Choose Exam Year</option>
                            <?php 
                                    $now = date('Y', strtotime('today')); 
                                    $last = $now + 3;
                                    ?>
                                    
                                    @for ($i = ($now - 1); $i <= $last; $i++) 
                                    

                                    <option value="{{ $i }}">
                                        {{ $i }}
                                        </option>
                                        @endfor

                                        
                        </select>
                    </div>
                    <button class="primary-btn text-uppercase">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End search-course Area -->

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
                        <p>
                            {!! $value->writeup!!}
                        </p>
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
