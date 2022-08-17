<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $buttons = [
            ['Add New',route('river.users.create'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'users' => $users,
            'title' => 'Users',
            '_top_buttons' => $buttons
        ];

        return view('river::admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buttons = [
            ['Back',route('river.users.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Add User',
            '_top_buttons' => $buttons
        ];

        return view('river::admin.users.create', $data);
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
//        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('river.users.index')->with('success', 'Successfully Created done!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buttons = [
            ['Back',route('river.users.index'), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $user = User::findOrFail($id);
        $data = [
            'title' => 'Edit User',
            '_top_buttons' => $buttons,
            'user' => $user
        ];
        return view('river::admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email'  =>  'required|email|max:255||unique:users,id,'.$id,
            'password' => 'string|min:6',
        ]);

        $user = User::FindOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
//        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('river.users.index')->with('success', 'Successfully Created done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Successfully Deleted done!');
    }
}
