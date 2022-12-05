<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class UpdController extends Controller
{

    public function index()
    {
        $updates = Announcement::orderby('expiry', 'desc')->paginate(20);
        return view('admin/announcements', ['updates' => $updates]);
    }

    public function add()
    {
        return view('admin/add_announcement');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'body' => ['required'],
            'source' => ['required'],
            'expiry' => ['required', 'date'],
        ]);

        Announcement::create([
            'title' => ucwords($request->title),
            'body' => $request->body,
            'expiry' => date('Y-m-d', strtotime($request->expiry)),
            'source' => $request->source,
        ]);

        $request->session()->flash('message', 'New Update Published Successfully');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect('/dash/announcement/all');
    }

    public function edit(Request $request, Announcement $announcement)
    {

        return view('/admin/edit_announcement', ['upd' => $announcement]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->validate($request, [
            'title' => ['required'],
            'body' => ['required'],
            'source' => ['required'],
            'expiry' => ['required', 'date'],
        ]);

        $result = Announcement::where('id', $announcement->id)
            ->update(['title' => $request->title, 'body' => $request->body, 'source' => $request->source, 'expiry' => $request->expiry,
            ]);

        $request->session()->flash('message', 'Update Successfully !');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect('/dash/announcement/all');
    }

    public function destroy(Request $request, Announcement $u)
    {
        $result = $announcement->delete();

        if ($result == true) {
            $request->session()->flash('message', 'Update Successfully deleted!');
            $request->session()->flash('alert-class', 'alert-success');
        } else {
            $request->session()->flash('message', 'Update not deleted, please retry!');
            $request->session()->flash('alert-class', 'alert-danger');
        }

        return redirect('/dash/announcement/all');

    }

    public function latest(Announcement $announcement)
    {
        return ['update'=>$announcement];
    }

}
