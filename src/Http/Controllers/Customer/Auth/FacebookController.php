<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('facebook')->stateless()->user();

        $findOldUser = Customer::where('email',$socialUser->email)->first();

        if ($findOldUser){

            Auth::guard('customer')->login($findOldUser);

            return redirect('/shop');

        }else{

            $customer = new Customer();
            $customer->name = $socialUser->name;
            $customer->email = $socialUser->email;
            $customer->fb_id = $socialUser->id;
            $customer->is_fb_user = 1;
            $customer->avatar = $socialUser->avatar;
            $customer->password = Hash::make('1234');
            $customer->save();

            Auth::guard('customer')->login($customer);

            return redirect('/shop');
        }
    }
}
