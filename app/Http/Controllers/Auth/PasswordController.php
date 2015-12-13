<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectPath = '/';
    /**
     * Create a new password controller instance.
     *
     * @return void
     */

    protected function resetPassword($user, $password){
        $user->password = $password;
        $user->save();
        Auth::login($user);
    }


    public function __construct(Guard $auth, PasswordBroker $passwords )
    {
        $this->auth=$auth;
        $this->passwords=$passwords;
        $this->middleware('guest');
    }
}
