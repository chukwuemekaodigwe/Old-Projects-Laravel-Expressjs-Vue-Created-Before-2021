<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Comment_Reply;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where(['status' => '1', 'type' => '1'])->orderby('id', 'desc')->paginate(20);
        $change_status = $this->changeStatus($comments);

        return view('admin.comments', ['comments' => $comments]);
    }

    /**
     * Below is used to mark a comments read
     */

    public function changeStatus($comments = '')
    {
        if (!empty($comments) && is_array($comments)) {
            foreach ($comments as $value) {
                Comment::where('id', $value['id'])->update(['status' => 2]);
            }
        } elseif ($comments == true) {
            Comment::where('status', 1)->update(['status' => 2]);
        } elseif ($comments == false) {
            $now = date('Y-m-d', strtotime('today'));
            Comment::where('status', 1)->update(['status' => 2]);
        }
        return true;
    }

    public function markAsRead(Request $request)
    {
        $this->changeStatus(true);
        $request->session()->flash('messae', 'Successfully Marked as Read');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect('/dash/comments/read');
    }

    public function markAsUnread(Request $request)
    {
        $this->changeStatus(false);
        $request->session()->flash('messae', 'Successfully Marked as Unread');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect('/dash/comments/unread');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function read()
    {
        $comments = Comment::withTrashed()->where([['status', '!=', '1'], ['type', '1']])->orderby('id', 'desc')->paginate(20);
        return view('admin.read_comments', ['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => ['required', 'max:100', 'string'],
            'email' => ['required', 'email', 'max:200'],
            'msg' => ['required', 'string', 'max:1000'],
            'blog_id' => ['required', 'integer', 'min:1'],
        ]);
        

        $result = Comment::create([
            'guest_name' => $request->name,
            'guest_email' => $request->email,
            'body' => $request->msg,
            'blog_id' => $request->blog_id,
            'type' => 1,
            'status' => 1,
        ]);
    $request->session()->flash('message', 'Successful, Thanks for your time!<br> Please note the comment is subject to be verified before its made public');
        $request->session()->flash('alert-class', 'alert-success');
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'reply' => ['required'],
        ]);

        $comment->update([
            'status' => '3',
        ]);
        $reply = new Comment_Reply;
        $reply::create([
            'comment_id' => $comment->id,
            'body' => $request->reply,
        ]);

        $request->session()->flash('message', 'Comment Reply Published successfully!');
        $request->session()->flash('alert-class', 'alert-success');

        return view('admin.read_comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {

        $comment->delete();

        $request->session()->flash('messae', 'Successfully Hidden');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect('/dash/comments/unread');

    }
}
