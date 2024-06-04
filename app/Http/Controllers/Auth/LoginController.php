<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            $user->sendEmailVerificationNotification();
            return redirect()->route('login')
                ->with('warning', 'Vous devez vérifier votre adresse e-mail. Un nouveau lien de vérification a été envoyé à votre adresse e-mail.');
        }
        if (!$user->is_active()) {
            auth()->logout();
            return redirect()->route('login')
                ->with('warning', 'Votre compte est désactivé. Veuillez contacter les administrateurs !');
        }
    }
}
