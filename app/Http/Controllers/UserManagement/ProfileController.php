<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Domain\UserManagement\Entities\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth::user();

        return view('profile.index', ['profile' => $profile]);
    }

    public function updatePassword(Request $request)
    {
        $user       = Auth::user();

        $validation = Validator::make($request->all(), [
            'old_password'  => 'required|hash:'  . $user->password,
            'new_password'  => 'required|different:old_password',
            'password_confirmation' => 'required|same:new_password'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        $user->password     = Hash::make($request->get('password_confirmation'));
        $user->save();

        return redirect()->route('profile.index')->with('status', 'Password successfully updated');
    }

    public function edit()
    {
        $profile            = User::find(Auth::user()->id);
        return view('profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email|unique:users,email,'.$id.',id',
            'address'   => 'required|min:15',
            'phone'     => 'required|digits_between:10,16',
        ])->validate();

        $profile        = User::findOrFail($id);

        $profile->name     = $request->get('name');
        $profile->email    = $request->get('email');
        $profile->address  = $request->get('address');
        $profile->phone    = $request->get('phone');

        if ($request->file('avatar')) {
            if ($profile->avatar && file_exists(storage_path('app/public'. $profile->avatar))) {
                Storage::delete('public/'. $profile->avatar);
            }
            $file   = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar   = $file;
        }

        $profile->save();

        return redirect()->route('profile.edit')->with('status', 'Profile successfully updated');
    }
}
