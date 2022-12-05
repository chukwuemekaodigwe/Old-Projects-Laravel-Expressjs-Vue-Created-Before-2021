<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function single(Category $category, Blog $blog)
    {
        $categories = Category::all();
        $posts = Blog::where(['status'=>'1', 'category_id'=>$category->id])->orderby('updated_at', 'desc')->get();
        //$posts = $blog->category->simplePaginate(20);
        return view('blog', ['blog' => $blog, 'categories'=>$categories, 'blogs'=>$posts]);
    }
    
public function recent(){
    $categories = Category::all();
    $posts = Blog::where('status', '1')->orderby('updated_at', 'desc')->paginate(20);
    return view('recent_blogs', ['blogs' => $posts, 'categories'=>$categories ]);
}

public function by_category(Category $category)
    {
        
        $categories = Category::all();
    $posts = Blog::where(['status'=>'1', 'category_id'=>$category->id])->orderby('updated_at', 'desc')->paginate(20);
        return view('recent_blogs', ['blogs' => $posts, 'categories'=>$categories ]);
    }

    public function index()
    {
        $posts = Blog::where('status', '1')->orderby('updated_at', 'desc')->paginate(20);
        return view('admin.blogs', ['posts' => $posts]);
    }

    public function add()
    {
        $categories = Category::orderby('name', 'asc')->get();
        return view('admin.add_blog', ['categories' => $categories]);
    }

    public function store(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title' => ['required', 'max:70', 'unique:blogs'],
            'summary' => ['required', 'max:130', 'min:20'],
            'body' => ['required'],
            'writer_name' => ['required'],
            'categ' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg', 'max:3000'],
            'tags' => ['required'],
        ]);

        $summary = $request->summary; 
        $tags = str_replace(',', ' | ', $request->tags);
        $pub = ($request->req == 'pub') ? date('Y-m-d', strtotime('today')) : null;
        $status = ($request->req == 'pub') ? '1' : '2';
$title = str_replace(' ', '-', strtolower($request->title));
        $cate_name = Category::find($request->categ);
        $url = $title;

        $result = Blog::create([
            'title' => $request->title,
            'summary' => $summary,
            'tags' => $tags,
            'body' => $request->body,
            'writer_name' => ucwords($request->writer_name),
            'category_id' => $request->categ,
            'url' => $url,
            'status' => $status,
            'publish_date' => $pub,

        ]);

        if ($result == true) {
            $imageName = $title . '.jpeg';
            $pix = request()->image->move(public_path('img/header'), $imageName);
            
            if (($request->req == 'pub')) {
                $request->session()->flash('message', 'Blog Post Published Successfully');
            } else {
                $request->session()->flash('message', 'Blog Post Saved Successfully');

            }

            $request->session()->flash('alert-class', 'alert-success');
        } else {
            $request->session()->flash('message', 'Unsuccessful, retry');
            $request->session()->flash('alert-class', 'alert-danger');

        }

        return redirect('/dash/blogs/all');

    }


    public function drafts()
    {
        $posts = Blog::where('status', '2')->orderby('updated_at', 'desc')->paginate(20);
        return view('admin.drafts', ['posts' => $posts]);
    }

    public function edit(Blog $blog)
    {
        $categories = Category::orderby('name', 'asc')->get();
        return view('admin.edit_blog', ['blog'=>$blog, 'categories'=> $categories]);
    }

    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title' => ['required', 'max:70'],
            'summary' => ['required', 'max:130', 'min:20'],
            'body' => ['required'],
            'writer_name' => ['required'],
            'categ' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg', 'max:3000'],
            'tags' => ['required'],
        ]);

        $summary = $request->summary; 
        $tags = str_replace(',', ' | ', $request->tags);
        $pub = ($request->req == 'pub') ? date('Y-m-d', strtotime('today')) : null;
        $status = ($request->req == 'pub') ? '1' : '2';
$title = str_replace(' ', '-', strtolower($request->title));
        $cate_name = Category::find($request->categ);
        $url = $title;

        $result = $blog->update([
            'title' => $request->title,
            'summary' => $summary,
            'tags' => $tags,
            'body' => $request->body,
            'writer_name' => ucwords($request->writer_name),
            'category_id' => $request->categ,
            'url' => $url,
            'status' => $status,
            'publish_date' => $pub,            
        ]);


        if ($result == true) {
            $imageName = $title . '.jpeg';
            $pix = request()->image->move(public_path('img/header'), $imageName);
            
            if (($request->req == 'pub')) {
                $request->session()->flash('message', 'Blog Post Published Successfully');
            } else {
                $request->session()->flash('message', 'Blog Post Saved Successfully');

            }

            $request->session()->flash('alert-class', 'alert-success');
        } else {
            $request->session()->flash('message', 'Unsuccessful, retry');
            $request->session()->flash('alert-class', 'alert-danger');

        }


        return redirect('/dash/blogs/all');    }

    public function destroy(Blog $blog, Request $request)
    {
        $result = $blog->delete();
    
    if($result == true){
        $request->session()->flash('message', 'Blog Post  Successfully deleted!');
        $request->session()->flash('alert-class', 'alert-success');
    }else{
        $request->session()->flash('message', 'Blog Post  not deleted, please retry!');
        $request->session()->flash('alert-class', 'alert-danger');
    }

    return back();
    }

    public function search(Request $request){
        $this->validate($request, [
            'title'=> ['required', 'min:1'],
        ]);

        $result = Blog::where('title', $request->title)->get();

        if(!empty($result)){
            $request->session()->flash('message', 'Blog Post  Found');
        $request->session()->flash('alert-class', 'alert-success');
            return view('admin.drafts')->with(['posts'=>$result, 'single'=>1]);
        }else{
            $request->session()->flash('message', 'Blog Post  Not Found!, Please crosscheck the title ');
        $request->session()->flash('alert-class', 'alert-danger');
            back();
        }
        
    }
}