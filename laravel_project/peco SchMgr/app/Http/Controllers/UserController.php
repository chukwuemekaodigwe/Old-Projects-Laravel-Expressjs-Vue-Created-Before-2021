<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function add()
    {
        return view('auth.register');
    }

    public function edit(User $user)
    {
        return view('admin.edit_user', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
            'type' => ['required', 'min:1', 'integer'],
        ]);

        $upd = User::where('id', $user->id
        )->update(['name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ulevel' => $request->type,
        ]
        );
        $request->session()->flash('message', 'Account Update Successful');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect('/dash/users/all');
    }

    public function destroy(Request $request, User $user)
    {
        $test = $user->delete();
        $request->session()->flash('messagge', 'Successfully deleted the user account!');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect('dash/users/all');
    }

}
