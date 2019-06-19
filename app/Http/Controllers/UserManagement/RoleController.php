<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Domain\UserManagement\Entities\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword    = $request->get('keyword');

        $roles = Role::where('name', 'LIKE', "%$keyword%")
        ->orderBy('updated_at', 'DESC')
        ->paginate(20);

        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation     = $request->validate([
            'name'      => 'required|max:25',
            'description'   => 'max:200'
        ]);

        $role               = new Role();
        $role->name         = $request->get('name');
        $role->slug         = str_slug($request->get('name'));
        $role->description  = $request->get('description');
        $role->created_by   = Auth::user()->id;
        $role->save();

        return redirect()->route('roles.create')->with('status', 'Role successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\UserManagement\Entities\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role       = Role::find($id);

        return view('roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\UserManagement\Entities\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name'          => 'required|max:25',
            'description'   => 'max:200'
        ]);

        $role               = Role::find($id);
        $role->name         = $request->get('name');
        $role->slug         = str_slug($request->get('name'));
        $role->description  = $request->get('description');
        $role->updated_by   = Auth::user()->id;
        $role->save();

        return redirect()->route('roles.edit', ['role' => $role])->with('status', 'Role successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\UserManagement\Entities\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role   = Role::find($id);
        $role->delete();

        return redirect()->route('roles.index')->with('status', 'Role successfully deleted!');
    }
}
