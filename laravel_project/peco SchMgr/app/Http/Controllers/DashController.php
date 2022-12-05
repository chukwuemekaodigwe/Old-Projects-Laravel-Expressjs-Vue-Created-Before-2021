<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\Blog;
use App\Comment;

class DashController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    public function index(){
        $drafts = Blog::where('status', 2)->orderby('id', 'desc')->get();
        $public = Blog::where('status', 1)->orderby('id', 'desc')->get();
        $user = User::all();
        $students = Student::where('status', 1)->orderby('id', 'desc')->get();
        $new = Student::where('status', 0)->orderby('id', 'desc')->get();
        
        return view('admin.dash', ['drafts'=>$drafts, 'blogs'=>$public, 'users'=>$user, 'new_student'=>$new, 'students'=>$students]);
    }
}
