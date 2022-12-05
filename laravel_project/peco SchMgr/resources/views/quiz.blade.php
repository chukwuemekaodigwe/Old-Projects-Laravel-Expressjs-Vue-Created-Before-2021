@extends('layouts.app')

@section('content')

    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        CBT Arena
                    </h1>

                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!--ADs-->
    <!-- Start top-category-widget Area -->
    <section class="top-category-widget-area pt-90 pb-90 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <a href="#" target="_blank">
                                <div class="thumb">
                                    <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget1.jpg" alt="">
                                </div>
                                <div class="content-details">
                                    <h4 class="content-title mx-auto text-uppercase">Social life</h4>
                                    <span></span>
                                    <p>Enjoy your social life together</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <a href="#" target="_blank">
                                <div class="thumb">
                                    <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget2.jpg" alt="">
                                </div>
                                <div class="content-details">
                                    <h4 class="content-title mx-auto text-uppercase">Politics</h4>
                                    <span></span>
                                    <p>Be a part of politics</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-cat-widget">
                        <div class="content relative">
                            <div class="overlay overlay-bg"></div>
                            <a href="#" target="_blank">
                                <div class="thumb">
                                    <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget3.jpg" alt="">
                                </div>
                                <div class="content-details">
                                    <h4 class="content-title mx-auto text-uppercase">Food</h4>
                                    <span></span>
                                    <p>Let the food be finished</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End top-category-widget Area -->

    <!-- Start post-content Area -->
    <section class="post-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-3  col-md-3 meta-details">
                            <div class="single-sidebar-widget ads-widget">
                                <a href="#"><img class="img-fluid" src="img/blog/ads-banner.jpg" alt=""></a>
                            </div>
                            <br>
                            <ul class="tags">
                                <li><a href="#">Food,</a></li>
                                <li><a href="#">Technology,</a></li>
                                <li><a href="#">Politics,</a></li>
                                <li><a href="#">Lifestyle</a></li>
                            </ul>
                            <div class="user-details row">
                                <p class="user-name col-lg-12 col-md-12 col-6"><a href="#">Mark wiens</a> <span class="lnr lnr-user"></span></p>
                                <p class="date col-lg-12 col-md-12 col-6"><a href="#">12 Dec, 2017</a> <span class="lnr lnr-calendar-full"></span></p>
                                <p class="view col-lg-12 col-md-12 col-6"><a href="#">1.2M Views</a> <span class="lnr lnr-eye"></span></p>
                                <p class="comments col-lg-12 col-md-12 col-6"><a href="#">06 Comments</a> <span class="lnr lnr-bubble"></span></p>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                            <h3 class="pb-10 mb-0">Get Started </h3>
                            <p class="link-nav">
                                Please you need an access code to access the quiz. <a href="#" class="" style="font-weight: bold;"> Get it Now</a>

                            </p>
                            <hr>
                            <form class="form-wrap" action="">

                                <div class="mt-10">
                                    <input type="text" class="single-input" name="code" placeholder="Enter your Access Code" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Access Code'" />

                                </div>

                                <div class="mt-10 form-select" id="service-select">
                                    <select>
                                                <option datd-display="">Choose Exam</option>
                                                <option value="1"> WAEC</option>
                                                <option value="2"> JAMB</option>
                                                <option value="3"> POST UTME</option>
                                                <option value="4"> NECO</option>
                                            </select>
                                </div>
                                <div class="mt-10">
                                    <button class="genric-btn primary primary text-uppercase">Submit</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>

                </div>
                <div class="col-lg-4 sidebar-widgets">
                    <div class="widget-wrap">

                        <div class="single-sidebar-widget popular-post-widget">
                            <h4 class="popular-title">Popular Posts</h4>
                            <div class="popular-post-list">
                                <div class="single-post-list d-flex flex-row align-items-center">
                                    <div class="thumb">
                                        <img class="img-fluid" src="img/blog/pp1.jpg" alt="">
                                    </div>
                                    <div class="details">
                                        <a href="blog-single.html">
                                            <h6>Space The Final Frontier</h6>
                                        </a>
                                        <p>02 Hours ago</p>
                                    </div>
                                </div>
                                <div class="single-post-list d-flex flex-row align-items-center">
                                    <div class="thumb">
                                        <img class="img-fluid" src="img/blog/pp2.jpg" alt="">
                                    </div>
                                    <div class="details">
                                        <a href="blog-single.html">
                                            <h6>The Amazing Hubble</h6>
                                        </a>
                                        <p>02 Hours ago</p>
                                    </div>
                                </div>
                                <div class="single-post-list d-flex flex-row align-items-center">
                                    <div class="thumb">
                                        <img class="img-fluid" src="img/blog/pp3.jpg" alt="">
                                    </div>
                                    <div class="details">
                                        <a href="blog-single.html">
                                            <h6>Astronomy Or Astrology</h6>
                                        </a>
                                        <p>02 Hours ago</p>
                                    </div>
                                </div>
                                <div class="single-post-list d-flex flex-row align-items-center">
                                    <div class="thumb">
                                        <img class="img-fluid" src="img/blog/pp4.jpg" alt="">
                                    </div>
                                    <div class="details">
                                        <a href="blog-single.html">
                                            <h6>Asteroids telescope</h6>
                                        </a>
                                        <p>02 Hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-sidebar-widget ads-widget">
                            <a href="#"><img class="img-fluid" src="img/blog/ads-banner.jpg" alt=""></a>
                        </div>
                        <div class="single-sidebar-widget post-category-widget">
                            <h4 class="category-title">Post Catgories</h4>
                            <ul class="cat-list">
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Technology</p>
                                        <p>37</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Lifestyle</p>
                                        <p>24</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Fashion</p>
                                        <p>59</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Art</p>
                                        <p>29</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Food</p>
                                        <p>15</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Architecture</p>
                                        <p>09</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex justify-content-between">
                                        <p>Adventure</p>
                                        <p>44</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End post-content Area -->
@endsection

