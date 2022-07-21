<?php

namespace Rashidul\River\Utility;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Rashidul\River\Models\Role;

class RolesCache
{


    public static function hasPermission($permission, $type)
    {
        $role = self::getAuthRole();

        if ($role == null) return false;
        if ($role->is_developer) return true;

        $check = $role->permissions->first(function ($value, $key) use($permission, $type){
            return (($value->permission == $permission)
                && ($value->type == $type));
        });

        if ($check) return true;

        return false;
    }

    public static function isDeveloper()
    {
        $role = self::getAuthRole();

        if ($role == null) return false;
        return (bool)$role->is_developer;
    }

    public static function getAuthRole()
    {
        $user = Auth::guard('admins')->user();
        $role_id = $user->role_id;
        return Cache::rememberForever('_permissions', function () use ($role_id) {
            return Role::with('permissions')
                ->where('id', $role_id)
                ->first();
        });
    }
}
