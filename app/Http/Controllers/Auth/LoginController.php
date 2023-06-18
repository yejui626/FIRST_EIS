<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

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


    protected function login(Request $request){
        

        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials)){
            $user=Auth::user()->role;
            

            switch($user){
                case 1:
                    return redirect('/Sales');
                    break;
                
                case 2:
                    return redirect('/Purchaser');
                    break;
                
                case 3:
                    return redirect('/Store');
                    break;

                case 4:
                    return redirect('/Logistic');
                    break;

                case 5:
                    session()->put('role', '5');
                    return redirect('/customer');
                    break;
                case 6:
                    return redirect('/Admin');
                    break;

                default:
                    Auth::logout();
                    return redirect('/login')->with('Error','Something Went Wrong!!!');
            }
        }else{
            return redirect('/login');
        }
    }
}
