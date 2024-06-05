<?php

namespace BitPixel\SpringCms\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController
{
    public function showDashboard()
    {
        return view('_cache.user-dashboard');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth('customers')->user();
        $data = [
          'user' => $user,
        ];

        return view('_cache.edit-profile', $data);
    }

    public function editProfile()
    {
        $user = auth('customers')->user();
        $data = [
            'user' => $user,
        ];
        return view('_cache.edit-profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        $user = auth('customers')->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePasswordPage()
    {
        return view('_cache.update-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed|different:old_password',
        ]);

        $user = auth('customers')->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            return redirect()->back()->with('success', 'Password changed');

        } else {
            return redirect()->back()->with('error', 'Wrong password!');
        }
    }


}
