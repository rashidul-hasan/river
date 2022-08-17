<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rashidul\River\Models\Role;
use Session;

class UsersRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        $data = [
            'roles' => $roles,
            'title' => 'User Roles',
        ];

        return view('river::admin.users-role', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        ]);
        $role = new Role();
        $role->name = $request->name;
        if (isset($request->is_active)) {
            $role->is_active = true;
        }
        $role->save();
        Session::flash('success', 'Blog created successfully');

        return redirect()->back();

//        return redirect()->route('river.users.index')->with('success', 'Successfully Created done!');
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
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        if (isset($request->is_active)) {
            $role->is_active = true;
        }
        $role->save();
        Session::flash('success', 'Blog Updated successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Role::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Successfully Deleted done!');
    }
}
