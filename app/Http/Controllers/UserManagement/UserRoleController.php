<?php

namespace App\Http\Controllers\UserManagement;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();

            $user   = User::find($id);
            if ($user->id == '1') {
                if ($user->findBySlug('admin')) {

                }
            }
            $user->roles()->sync($request->get('roles'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function findRoleByUser($id)
    {
        $user = User::find($id)->roles()->get();
        return $user;
    }
}
