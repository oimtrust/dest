<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users              = User::orderBy('updated_at', 'DESC')->paginate(10);

        $filter_keyword     = $request->get('keyword') ? $request->get('keyword') : '';
        $status             = $request->get('status');

        if ($status) {
            $users  = User::where('status', $status)->orderBy('updated_at', 'DESC')->paginate(10);
        } else {
            $users  = User::orderBy('updated_at', 'DESC')->paginate(10);
        }

        if ($filter_keyword) {
            if ($status) {
                $users  = User::where('name', 'LIKE', "%$filter_keyword%")
                    ->where('status', $status)
                    ->orderBy('updated_at', 'DESC')->paginate(10);
            } else {
                $users  = User::where('name', 'LIKE', "%$filter_keyword%")
                    ->orderBy('updated_at', 'DESC')->paginate(10);
            }
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|unique:users|email',
            'password'  => 'required|min:8',
            'address'   => 'required|min:15',
            'phone'     => 'required|digits_between:10,16',
            'avatar'    => 'required|image'
        ]);

        $new_user   = new User();

        $new_user->name         = $request->get('name');
        $new_user->email        = $request->get('email');
        $new_user->password     = Hash::make($request->get('password'));
        $new_user->phone        = $request->get('phone');
        $new_user->address      = $request->get('address');
        $new_user->created_by   = Auth::user()->id;

        if ($request->file('avatar')) {
            $file               = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar   = $file;
        }

        $new_user->save();

        return redirect()->route('users.create')->with('status', 'User successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\UserManagement\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user   = User::findOrFail($id);

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\UserManagement\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user   = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\UserManagement\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email',
            'address'   => 'required|min:15',
            'phone'     => 'required|digits_between:10,16',
        ])->validate();

        $user               = User::findOrFail($id);

        $user->name         = $request->get('name');
        $user->email        = $request->get('email');
        $user->status       = $request->get('status');
        $user->address      = $request->get('address');
        $user->phone        = $request->get('phone');
        $user->updated_by   = Auth::user()->id;

        if ($request->file('avatar')) {
            if ($user->avatar && file_exists(storage_path('app/public'. $user->avatar))) {
                Storage::delete('public/'. $user->avatar);
            }
            $file   = $request->file('avatar')->store('avatars', 'public');
            $user->avatar   = $file;
        }

        $user->save();

        return redirect()->route('users.edit', ['id' => $id])->with('status', 'User successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\UserManagement\Entities\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user    = User::findOrFail($id);

       if (!$user->delete()) {
           return redirect()->back();
       }

       $user->deleted_by    = Auth::user()->id;
       $user->save();
       $user->delete();

       return redirect()->route('users.index')->with('status', 'User moved to trash');
    }

    public function trash(Request $request)
    {
        $users   = User::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);

        $keyword   = $request->get('keyword') ? $request->get('keyword') : '';

        $users  = User::onlyTrashed()->where('name', 'LIKE', "%$keyword%")
            ->orderBy('deleted_at', 'DESC')->paginate(10);

        return view('users.trash', ['users' => $users]);
    }

    public function restore($id)
    {
        $user    = User::onlyTrashed()->findOrFail($id);

        if ($user->trashed()) {
            $user->restore();
        } else {
            return redirect()->route('trash.users')->with('status', 'User is not in trash');
        }
        return redirect()->route('trash.users')->with('status', 'User successfully restored');
    }

    public function deletePermanent($id)
    {
        $user    = User::onlyTrashed()->findOrFail($id);
        $avatar  = $user->avatar;

        if (!$user->trashed()) {
            return redirect()->route('trash.users')->with('status', 'Can not delete permanent active user');
        } else {
            $user->forceDelete();

            if ($avatar) {
                $filepath    = 'storage/' . $user->avatar;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                     $e->getMessage();
                }
            }
            return redirect()->route('trash.users')->with('status', 'User permanently deleted!');
        }
    }

}
