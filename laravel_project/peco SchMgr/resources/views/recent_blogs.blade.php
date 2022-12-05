@extends('layouts.app')

@section('content')

<!-- start banner Area -->
<section class="banner-area relative blog-home-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content blog-header-content col-lg-12">
                <h1 class="text-white">
                    Dude You’re Getting
                    a Telescope
                </h1>
                <p class="text-white">
                    There is a moment in the life of any aspiring astronomer that it is time to buy that first
                </p>
                <a href="#blogs" class="primary-btn">View More</a>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start top-category-widget Area -->
<section class="top-category-widget-area pt-90 pb-90 " id="blogs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-cat-widget">
                    <div class="content relative">
                        <div class="overlay overlay-bg"></div>
                        <a href="#" target="_blank">
                            <div class="thumb">
                                <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget1.jpg"
                                    alt="">
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
                                <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget2.jpg"
                                    alt="">
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
                                <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget3.jpg"
                                    alt="">
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
            <div class="col-lg-9 posts-list">
                @foreach($blogs as $blog)

                <?php
$tags = explode('|', $blog->tags);
?>
                <div class="single-post row">

                    <div class="col-lg-12 col-md-12 ">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{asset('/img/header/'.$blog->url)}}.jpeg" alt="{{$blog->title}}"
                                style="height: 200px; width: 100%!important">
                        </div>
                        <div>
                            <a class="posts-title" href="{{ url('/blogs/'.$blog->category->name.'/'.$blog->url) }}">
                                <h3> {{$blog->title }}</h3>
                            </a>
                            <p class="excert">
                                {!! $blog->summary !!}
                            </p>
                        </div>
                        <div class="meta-details">
                            <p> Tags: &nbsp;
                                @foreach($tags as $tag)
                                <a href="#"> {{ucwords($tag) }},</a>
                                @endforeach
                            </p>
                            <div class="user-details row">
                                <p class="user-name col-lg-12 col-md-12 col-6"> <span class="lnr lnr-user"></span><a
                                        href="#">{{ucwords($blog->writer_name)}}</a>


                                    <span class="lnr lnr-calendar-full"></span>
                                    <a href="#">
                                        {{date('M j, Y', strtotime($blog->publish_date))}}
                                    </a>


                                    <span class="lnr lnr-bubble"></span>
                                    <a href="#"> {{count($blog->comments)}}
                                        Comments</a>
                                </p>
                            </div>
                        </div>
                        <a href="{{ url('/blogs/'.$blog->category->name.'/'.$blog->url) }}" class="primary-btn">View More</a>
                    </div>
                </div>


                @endforeach

                <nav class="blog-pagination justify-content-center d-flex">
                    {{$blogs->links() }}
                </nav>
            </div>
            <div class="col-lg-3 sidebar-widgets">
                <div class="widget-wrap">

                    <div class="single-sidebar-widget ads-widget">
                        <a href="#"><img class="img-fluid" src="img/blog/ads-banner.jpg" alt=""></a>
                    </div>
                    <div class="single-sidebar-widget post-category-widget">
                        <h4 class="category-title">Post Catgories</h4>
                        <ul class="cat-list">
                            <li>
                                <a href="/blogs/" class="d-flex justify-content-between">
                                    <p> All Categories </p>

                                </a>
                            </li>
                            @foreach($categories as $category)

                            <li>
                                <a href="/blogs/categories/{{$category->name}}" class="d-flex justify-content-between">
                                    <p> {{ucwords($category->name)}}</p>
                                    <p>{{count($category->blogs)}}</p>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- End post-content Area -->

@endsection