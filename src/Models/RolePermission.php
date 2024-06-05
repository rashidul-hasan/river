<?php

namespace BitPixel\SpringCms\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    public $table = 'river_role_permission';

    protected $guarded = ['id'];

    const TYPE_ROUTE = 1;
    const TYPE_CUSTOMTYPE = 2;

    /*
     * there are two types of permissions.

    1. route based
    2. type based


    route based perm are handled by route name. if a role has permission for certain route names, that
    role can access that route. show a list of route names on admin panel. exclude system routes
    and routes provided by other packages. this check will be handled by the CheckRole middleware

    get list of routes of our project

    $routeCollection = Illuminate\Support\Facades\Route::getRoutes();

    foreach ($routeCollection as $value) {
        echo $value->getName();
        echo '<br>';
    }

    type based route are for handling custom types stored in river_types table.
    show list of types with their operations(view list, create, edit, delete)
     and assign them to a role. this check will be handled on type entry controller
     *
     *
     * */


    //const TYPE_CUSTOMTYPE = 2;
//    <type slug>.index
//    <type slug>.create
//    <type slug>.update
//    <type slug>.delete
//
//    if dont have permission for index, other 3 is disabled & restricted by default

}
