<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\UserManagement\Entities\Role;
use App\Domain\UserManagement\Entities\User;

class UserRoleController extends Controller
{
    public function index(Request $request)
    {
        $keyword    = $request->get('keyword');

        $users = User::with('roles')->where('name', 'LIKE', "%$keyword%")
        ->orderBy('updated_at', 'DESC')
        ->paginate(20);

        return view('roles.userrole', ['users' => $users]);
    }

    public function ajaxSearchRole(Request $request)
    {
        $keyword    = $request->get('q');
        $roles      = Role::select('id','name')->where('name', 'LIKE', "%$keyword%")->get();
        return $roles;
    }

    public function attachRole(Request $request, $id)
    {
        $user   = User::find($id);

        $user->roles()->sync($request->get('roles'));
    }

    public function findRoleByUser($id)
    {
        $user = User::find($id)->roles()->get();
        return $user;
    }
}
