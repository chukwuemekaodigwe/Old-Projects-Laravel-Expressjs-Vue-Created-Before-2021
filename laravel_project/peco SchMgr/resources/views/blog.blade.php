@extends('layouts.app')
@section('meta')
<meta name="tags" content="css, custom example" />
@endsection

@section('content')
<style>
.blog-body{
    display: block;
    width: 100%!important;
}

.blog-body img{
    width: 100%!important;
}
</style>
<section class="banner-area relative" id="home"
    style="background: url('{{asset('img/header/'.$blog->url.'.jpeg')}}')!important; background-size: cover!important;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    {{ strtoupper($blog->title) }}
                </h1>
                <p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span><a
                        href="/blogs/">Blogs </a> <span class="lnr lnr-arrow-right"></span> <a href="">{{$blog->title}}
                    </a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- Start post-content Area -->
<section class="post-content-area single-post-area">

    <div class="container">
        @include('includes.feedback')
        <div class="row">

            <div class="col-lg-9 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">

                        <div class="feature-img">
                            <img class="img-fluid" src="{{asset('img/header/'.$blog->id.'.jpeg')}}"
                                style="height:300px; width:100%; display: none;" alt="{{$blog->title}}">
                        </div>
                        <div class="single-sidebar-widget ads-widget">
                            <a href="#"><img class="img-fluid" src="img/blog/ads-banner.jpg" alt=""></a>
                        </div>
                    </div>

                    <?php
$tags = explode('|', $blog->tags);
?>
                </div>
                <div class="single-post row">
                    <div class="col-lg-12">
                        <h2 title="{{$blog->summarry}}"> {{$blog->title}} </h2>
                        <div class="blog-body">{!! $blog->body !!} </div>
                    </div>
                </div>

                <div class="user-details row">
                    <p class="user-name col-lg-12 col-md-12 col-6"> <span class="lnr lnr-user"></span><a href="#">
                            &nbsp;{{ucwords($blog->writer_name)}}</a>


                        <span class="lnr lnr-calendar-full"></span>
                        <a href="#"> &nbsp;
                            {{date('M j, Y', strtotime($blog->publish_date))}}
                        </a>


                        <span class="lnr lnr-bubble"></span>
                        <a href="#"> &nbsp;{{count($blog->comments)}}
                            Comments</a>
                    </p>

                </div>


                <div class="comments-area col-12">
                    <h4> {{count($blog->comments)}} Comments</h4>

                    @foreach($blog->comments as $comment)
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/user.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#"> {{ucwords($comment->guest_name)}}</a></h5>
                                    <p class="date">{{date('F g, Y h:i a', strtotime($comment->created_at))}}</p>
                                    <p class="comment">
                                        {{ucwords($comment->body)}}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>



                <div class="comment-form">
                    <h4>Leave a Comment</h4>
                    <form action="/comments/store" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="blog_id" value="1" />
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-12 name">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name"
                                    id="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'"
                                    required maxlength="50">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group col-lg-6 col-md-12 email">
                                <input type="email" class="form-control" name="email" placeholder="Enter email address"
                                    id="email" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter email address'" required maxlength="50">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="msg" placeholder="Messege" id="body"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""
                                maxlenghth="800"></textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="primary-btn text-uppercase">Post Comment</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-3 sidebar-widgets">
                <div class="widget-wrap">

                    <div class="single-sidebar-widget ads-widget">
                        <a href="#"><img class="img-fluid" src="img/blog/ads-banner.jpg" alt=""></a>
                    </div>
                    <div class="single-sidebar-widget popular-post-widget">
                        <h4 class="popular-title">Related Posts</h4>
                        <div class="popular-post-list">
                            @foreach($blogs as $value)

                            <div class="single-post-list d-flex flex-row align-items-center">
                                <div class="thumb" style="width: 100px;">
                                    <img class="img-fluid" src="{{asset('img/header/'.$value->url.'.jpeg')}}"
                                        alt="{{$value->title}}">
                                </div>
                                <div class="details">
                                    <a href="{{url('/blogs/'.$value->category->name.'/'.$value->url)}}">
                                        <h6> {{ucwords($value->title)}}</h6>
                                    </a>
                                    <p> {{$value->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            @endforeach

                        </div>
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

                    <div class="single-sidebar-widget tag-cloud-widget">
                        <h4 class="tagcloud-title">Tag Clouds</h4>
                        <ul>
                            @foreach($tags as $tag)
                            <li><a href="#"> {{ucwords($tag) }} </a></li>
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