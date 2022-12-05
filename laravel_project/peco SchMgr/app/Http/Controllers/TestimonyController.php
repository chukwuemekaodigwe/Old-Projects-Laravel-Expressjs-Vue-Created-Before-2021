<?php

namespace App\Http\Controllers;

use App\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    //

    public function index()
    {
        $testimonies = Testimony::where('type', 1)->get();
        return view('testimony', ['testimonies'=>$testimonies]);
    }

    public function add(Testimony $testimony)
    {
        $types = ['gallery pix', 'slide pix', 'events pix'];

        return view('admin.add_testimony', ['types' => $types]);
    }

    public function store(Request $request)
    {
        //var_dump($_FILES); die();
        $this->validate($request, [
            'title' => ['required', 'max:120', 'string'],
            'type' => ['required', 'min:1'],
            'desc' => ['required', 'max:1000'],
            'pix' => ['required', 'image', 'mimes:jpeg,gif,png', 'max:50000000'],
        ]);


        $title = str_replace(' ', '-', strtolower($request->title));
        $ext = request()->pix->getClientOriginalExtension();
        $imageName = $title . '.' . $ext;
        $path = 'img/'.$request->type.'/';

        $pix = request()->pix->move(public_path($path), $imageName);

        $result = Testimony::create([
            'title' => $request->title,
            'type' => $request->type,
            'writeup' => $request->desc,
            'path' => $path.$imageName,

        ]);

        if ($result == true) {
            $request->session()->flash('message', 'Uploaded Successfully');
            $request->session()->flash('alert-class', 'alert-success');
        } else {
            $request->session()->flash('message', 'An error occurred please try again');
            $request->session()->flash('alert-class', 'alert-danger');
        }

        return back();
    }

    public function edit(Testimony $testimony)
    {
        
        return view('admin.edit_testimony', ['testimony'=> $testimony]);
    }

    public function update(Request $request, Testimony $testimony)
    {

        $this->validate($request, [
            'title' => ['required', 'max:120', 'string'],
            'type' => ['required', 'min:1'],
            'desc' => ['required', 'max:1000'],
            'image' => ['required', 'image', 'mimes:jpeg,gif,png', 'max:50000000'],
        ]);


        $title = str_replace(' ', '-', strtolower($request->title));
        
        $ext = request()->image->getClientOriginalExtension();
        $imageName = $title . '.' . $ext;
        $path = 'img/'.$request->type.'/';

//unlink(public_path($testimony->path));

        $pix = request()->image->move(public_path($path), $imageName);

        $result = $testimony->update([
            'title' => $request->title,
            'type' => $request->type,
            'writeup' => $request->desc,
            'path' => $path.$imageName,
        ]);

        if ($result == true) {
            $request->session()->flash('message', 'Image Updated Successfully');
            $request->session()->flash('alert-class', 'alert-success');
        } else {
            $request->session()->flash('message', 'An error occurred please try again');
            $request->session()->flash('alert-class', 'alert-danger');
        }
$back = session('path');

        return redirect('/dash/testimonies/view/'.$back);
    }

    public function destroy(Request $request, Testimony $testimony)
    {
        $result = $testimony->delete();
        if($result == true){
            $request->session()->flash('message', 'Testimony Image Deleted successfully!');
            $request->session()->flash('alert-class', 'alert-success');
        }else{
            $request->session()->flash('message', 'Image not deleted, please retry!');
            $request->session()->flash('alert-class', 'alert-danger');
        }
    
        return back();
    }

    public function gallery()
    {
        $name = 'gallery';
        session(['path'=>$name]);
        $testimony = Testimony::where('type', '1')->paginate(30);
        return view('admin.testimony', ['testimonies' => $testimony, 'name'=>$name]);
    }

    public function slide()
    {
        $name = 'slide';
        session(['path'=>$name]);
        $testimony = Testimony::where('type', '2')->paginate(30);
        return view('admin.testimony', ['testimonies' => $testimony, 'name'=>$name]);

    }

    public function event()
    {
        $name = 'event';
        session(['path'=>$name]);
        $testimony = Testimony::where('type', '3')->paginate(30);
        return view('admin.testimony', ['testimonies' => $testimony, 'name'=>$name]);
    }

}
