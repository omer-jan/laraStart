<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function attemptLogin(Request $request)
      {



         $user = User::where('email', $request->email)->first();
         Auth::login($user);
         return redirect('/');
         // for checking purpose you can login with master paswword
        // dd(Hash::make("12janjan89"));
        // your master password  is 12janjan89
           // if (Hash::check($request->password,'$2y$10$JdHYAmrqpWME9iQ2Ia3F0uiu2uTPTDeB56gzBsFKRJan2p/CRxzEi'))
           //  {
           //    // login
           //     Auth::login($user);
           //
           //     return redirect('/');
           //  }
            // go for normal process
            // Employee/User Record Found



  }
}
