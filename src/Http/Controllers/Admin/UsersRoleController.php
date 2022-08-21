<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Models\DataType;
use Rashidul\River\Models\Role;
use Rashidul\River\Models\RolePermission;
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

        $buttons = [
            ['Add New',route('river.users-role.create'), 'btn btn-primary', 'btn-add-new'],
        ];

        $data = [
            'roles' => $roles,
            'title' => 'User Roles',
            '_top_buttons' => $buttons,
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
        $buttons = [
            ['Back', route('river.users-role.index'), 'btn btn-info', 'btn-add-new'],
        ];

        $routes = Route::getRoutes();
        $types = DataType::all();

        $data = [
            'title' => 'Create User Role',
            '_top_buttons' => $buttons,
            'routes' => $routes,
            'types' => $types,
        ];

        return view('river::admin.users-role-create', $data);
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
        if (isset($request->is_developer)) {
            $role->is_developer = true;
        }

        if ($role->save()){
            if ($request->route_names){
                foreach ($request->route_names as $route_name){
                    RolePermission::create([
                        'role_id' => $role->id,
                        'permission' => $route_name,
                        'type' => RolePermission::TYPE_ROUTE,
                    ]);
                }
            }

            if ($request->data_types){
                foreach ($request->data_types as $data_type){
                    RolePermission::create([
                        'role_id' => $role->id,
                        'permission' => $data_type,
                        'type' => RolePermission::TYPE_CUSTOMTYPE,
                    ]);
                }
            }

            Session::flash('success', 'Created successfully');
        }

        return redirect()->back();

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
        if (isset($request->is_developer)) {
            $role->is_developer = true;
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
