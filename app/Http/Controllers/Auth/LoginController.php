<?php

namespace App\Http\Controllers\Auth;

use App\Contest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->fields([
            'name', 'first_name', 'last_name', 'email'
        ])->user();
        $findUser = User::where('email', $user->email)->first();
        $contest_id = Contest::select('contest_id')->where('is_active', 1)->get()->first();

        if($findUser) {

            Auth::login($findUser);
            return redirect()->route('contest.index');

        } else {
            $user = User::create([
                'firstname' => $user['first_name'],
                'lastname' => $user['last_name'],
                'email' => $user['email'],
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'password' => bcrypt(123456),
                'contest_id' => $contest_id['contest_id']
            ]);

            Auth::login($user);
        }

        return redirect()->route('contest.index');
    }
}
