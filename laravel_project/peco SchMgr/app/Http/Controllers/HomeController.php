<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Announcement;
use App\Quote;
use App\Testimony;
use App\Comment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $day = date('Y-m-d', strtotime('today'));
        $announcement = Announcement::where('expiry', '>', $day)->get();
        $quote = Quote::latest('updated_at')->first();
        $blog = Blog::where('status', 1)->orderby('updated_at', 'desc')->take('5')->get();
        $event = Testimony::where('type', 3)->latest('updated_at')->limit(10)->get();
        $comment = Comment::where('status', 3)->latest()->limit(5)->get();
        return view('home', ['announcement'=>$announcement, 'blog'=>$blog, 'quote'=>$quote, 'event'=>$event, 'comments'=>$comment]);
    }

    public function about(){
        $day = date('Y-m-d', strtotime('today'));
        $announcement = Announcement::where('expiry', '>', $day)->get();
        $quote = Quote::latest('updated_at')->first();
        $blog = Blog::where('status', 1)->orderby('updated_at', 'desc')->take('5')->get();
        $event = Testimony::where('type', 1)->latest('updated_at')->limit(10)->get();
        return view('static.about', ['announcement'=>$announcement, 'blog'=>$blog, 'quote'=>$quote, 'event'=>$event]);
    }
} 
