<?php

namespace Rashidul\River\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Rashidul\River\Models\Role;
use Rashidul\River\Models\RolePermission;
use Rashidul\River\Utility\RolesCache;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        $route = $request->route()->getName();
        // need to skip this check for data entry routes, those will be handled
        // on the controller level
        if (in_array($route, [
            'river.data-entries.index',
            'river.data-entries.store',
            'river.data-entries.create',
            'river.data-entries.edit',
            'river.data-entries.destroy',
            'river.data-entries.update',
            'river.data-entries.show',
            'river.contact_form.store'
        ])) {
            return $next($request);
        }

        if (RolesCache::hasPermission($route, RolePermission::TYPE_ROUTE)) {
            return $next($request);
        }

        abort(503);
    }

    private function roleHasPermission($role_id, $permission)
    {
        //check perm from cache
        $role_permissions = $this->getRolewisePermissions();
        if (array_key_exists($role_id, $role_permissions)) {
            if (in_array('GOD', $role_permissions[$role_id])) return true;

            return in_array($permission, $role_permissions[$role_id]);
        }
        //        dd($role_permissions);
        return false;
    }

    private function getRolewisePermissions()
    {
        $data = Cache::rememberForever('_roles', function () {
            $all = Role::with('permissions')
                ->get();
            $arr = [];
            foreach ($all as $item) {
                $arr[$item->id] = $item->permissions->pluck('permission')
                    ->toArray();
            }

            return $arr;
        });

        return $data;
    }
}
