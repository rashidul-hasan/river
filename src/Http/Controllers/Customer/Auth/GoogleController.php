<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('google')->stateless()->user();

        $findOldUser = Customer::where('email',$socialUser->email)->first();

        if ($findOldUser){

            Auth::guard('customer')->login($findOldUser);

            return redirect('/shop');

        }else{

            $customer = new Customer();
            $customer->name = $socialUser->name;
            $customer->email = $socialUser->email;
            $customer->google_id = $socialUser->id;
            $customer->is_google_user = 2;
            $customer->avatar = $socialUser->avatar;
            $customer->password = Hash::make('1234');
            $customer->save();

            Auth::guard('customer')->login($customer);

            return redirect('/shop');
        }
    }
}
