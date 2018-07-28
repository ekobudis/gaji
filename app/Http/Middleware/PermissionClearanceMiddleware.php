<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class PermissionClearanceMiddleware
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
        if (Auth::user()->hasRole('Admin')) 
        {
            return $next($request);
        }
        if (Auth::user()->hasRole('User') ) 
        {
            if ($request->is('absen'))
            {
                return $next($request);
            }
            if ($request->is('profile'))
            {
                return $next($request);
            }
            if ($request->is('departments/create'))
            {
                if (!Auth::user()->hasPermissionTo('Add Departemen'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('departments'))
            {
                if (!Auth::user()->hasPermissionTo('View Departemen'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('positions/create'))
            {
                if (!Auth::user()->hasPermissionTo('Add Jabatan'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('positions'))
            {
                if (!Auth::user()->hasPermissionTo('View Jabatan'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('projects/create'))
            {
                if (!Auth::user()->hasPermissionTo('Add Proyek'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('projects'))
            {
                if (!Auth::user()->hasPermissionTo('View Proyek'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('employees/create'))
            {
                if (!Auth::user()->hasPermissionTo('Add Pegawai'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('employees'))
            {
                if (!Auth::user()->hasPermissionTo('View Pegawai'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('attends/create'))
            {
                if (!Auth::user()->hasPermissionTo('Add Absensi'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('attends'))
            {
                if (!Auth::user()->hasPermissionTo('View Absensi'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('advanceds/create'))
            {
                if (!Auth::user()->hasPermissionTo('Add Kasbon'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('advanceds'))
            {
                if (!Auth::user()->hasPermissionTo('View Kasbon'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('calculates'))
            {
                if (!Auth::user()->hasPermissionTo('View Gaji'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('dashboard'))
            {
                if (!Auth::user()->hasPermissionTo('View Dashboard'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('reports'))
            {
                if (!Auth::user()->hasPermissionTo('View Laporan'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
            if ($request->is('settings'))
            {
                if (!Auth::user()->hasPermissionTo('View Setting'))
                {
                   abort('401');
                } 
                else {
                   return $next($request);
                }
            }
        }
    }
}
