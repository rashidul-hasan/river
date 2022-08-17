<?php

namespace Rashidul\River\Http\Controllers\Customer;

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
        $user = auth()->user();

        $data = [
          'user' => $user,
        ];

        return view('site.user-dashboard.profile', $data);
    }

    public function editProfile()
    {
        $user = auth('customer')->user();

        $data = [
          'user' => $user,
        ];


        return view('site.user-dashboard.edit-profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function showChangePasswordPage()
    {
        return view('site.user-dashboard.change-password', []);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed|different:old_password',
        ]);

        $user = Auth::user();

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
