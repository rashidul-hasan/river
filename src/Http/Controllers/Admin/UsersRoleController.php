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

        $remove_routes = ['fm.initialize','fm.content','fm.tree','fm.select-disk','fm.upload','fm.delete','fm.paste','fm.rename','fm.download','fm.thumbnails','fm.preview',
                            'fm.url','fm.create-directory','fm.create-file','fm.update-file','fm.stream-file','fm.zip','fm.unzip','fm.ckeditor','fm.tinymce','fm.tinymce5','fm.summernote',
                            'fm.fm-button','debugbar.openhandler','debugbar.clockwork','debugbar.assets.css','debugbar.assets.js','debugbar.cache.delete','river.','riversite.login','riversite.login.post',
                            'riversite.register','riversite.register','riversite.customer.dashboard','riversite.customer.editProfile','riversite.update.profile','riversite.update.passwordPage',
                            'riversite.update.password','riversite.logout','riversite.homepage','ignition.healthCheck','ignition.executeSolution','ignition.updateConfig'
                        ];
        $route_name = [];

        foreach (Route::getRoutes() as $route) {
            if ($route->getName()){
                $route_name[] = $route->getName();
            }
        }

        $types = DataType::all();

        $data = [
            'title' => 'Create User Role',
            '_top_buttons' => $buttons,
            'routes' => $routes,
            'route_name' => $route_name,
            'remove_routes' => $remove_routes,
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
            ['Back', route('river.users-role.index'), 'btn btn-info', 'btn-add-new'],
        ];

        $routes = Route::getRoutes();
        $types = DataType::all();
        $role = Role::findOrFail($id);

        $remove_routes = ['fm.initialize','fm.content','fm.tree','fm.select-disk','fm.upload','fm.delete','fm.paste','fm.rename','fm.download','fm.thumbnails','fm.preview',
            'fm.url','fm.create-directory','fm.create-file','fm.update-file','fm.stream-file','fm.zip','fm.unzip','fm.ckeditor','fm.tinymce','fm.tinymce5','fm.summernote',
            'fm.fm-button','debugbar.openhandler','debugbar.clockwork','debugbar.assets.css','debugbar.assets.js','debugbar.cache.delete','river.','riversite.login','riversite.login.post',
            'riversite.register','riversite.register','riversite.customer.dashboard','riversite.customer.editProfile','riversite.update.profile','riversite.update.passwordPage',
            'riversite.update.password','riversite.logout','riversite.homepage','ignition.healthCheck','ignition.executeSolution','ignition.updateConfig'
        ];

        $route_name = [];

        foreach (Route::getRoutes() as $route) {
            if ($route->getName()){
                $route_name[] = $route->getName();
            }
        }

        $userCustomType = RolePermission::where('role_id', $id)->where('type', RolePermission::TYPE_CUSTOMTYPE)->get()->toArray();

        foreach ($userCustomType as $row){
            $userCustomType = $row;
        }

        $data = [
            'title' => 'Edit User Role',
            '_top_buttons' => $buttons,
            'routes' => $routes,
            'route_name' => $route_name,
            'remove_routes' => $remove_routes,
            'types' => $types,
            'role' => $role,
            'userCustomType' => $userCustomType,
        ];

        return view('river::admin.users-role-edit', $data);
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
        if ($data->delete()){
            RolePermission::where('role_id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Successfully Deleted done!');
    }
}
