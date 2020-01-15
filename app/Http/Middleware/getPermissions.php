<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\User as User;
use Closure;

class getPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $permissions = [];

        //format the permissions so only the name is given.
        foreach ($user->role->permissions as $permission) {
            $permissions[] = $permission->name;
        }

        //pass permissions to the request
        $request->attributes->add(['permissions' => $permissions]);

        return $next($request);
    }
}
