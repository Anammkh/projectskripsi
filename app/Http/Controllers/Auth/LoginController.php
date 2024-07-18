<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
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
    protected function redirectTo()
    {
        if (auth()->user()->roles !== 'admin') {
            return '/';
        } else{
            return '/home';
        }


    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => Lang::get('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        if (!\App\Models\User::where($this->username(), $request->{$this->username()})->first()) {
            $errors = [$this->username() => 'Username tidak ditemukan.'];
        } elseif (!\App\Models\User::where($this->username(), $request->{$this->username()})->where('password', bcrypt($request->password))->first()) {
            $errors = ['password' => 'Password salah.'];
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
