<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // protected function redirectTo( ) {
    //     if (Auth::check() && Auth::user()->user_type == 'moderator') {
    //         return('/moderator');
    //     }
    //     // elseif (Auth::check() && Auth::user()->role == 'agent') {
    //     //     return('/agent');
    //     // }
    //     else {
    //         return('/admin');
    //     }
    // }

    public function webLoginPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $remember_me = $request->has('remember_me') ? true : false;


        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
            $user = auth()->user();
            dd($user);
        } else {
            return back()->with('error', 'your username and password are wrong.');
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->createToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }
}
