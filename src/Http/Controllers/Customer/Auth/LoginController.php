<?php

namespace BitPixel\SpringCms\Http\Controllers\Customer\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Constants;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('river.guest:'.Constants::AUTH_GUARD_CUSTOMERS)->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());

        return view('_cache.login', ['title' => 'Login']);
    }

    public function customerLogin(Request $request)
    {
        if(Auth::guard('customers')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect()->intended('/');
        }else{
            return redirect()->back()->with('error','Credentials dose not match!');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    // override logout so cart contents remain:
    // https://github.com/Crinsane/LaravelShoppingcart/issues/253
    public function logout(Request $request)
    {
        $cart = collect(session()->get('cart'));

        $destination = \Auth::guard('customers')->logout();

        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) {
                session()->put('cart.' . $identifier, $rows);
            });
        }

        return redirect()->to($destination);
    }

    public function redirectTo()
    {
        return str_replace(url('/login'), '', session()->get('previousUrl', '/'));
    }
}
