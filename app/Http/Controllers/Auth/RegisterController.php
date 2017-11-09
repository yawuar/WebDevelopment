<?php

namespace App\Http\Controllers\Auth;

use App\Contest;
use App\ContestPhotos;
use App\Http\Controllers\Controller;
use App\Invite;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'number' => 'required|integer|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $contest_id = Contest::select('contest_id')->where('is_active', 1)->get()->first();
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'address' => $data['address'],
            'number' => $data['number'],
            'city' => $data['city'],
            'zipcode' => $data['zipcode'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'contest_id' => $contest_id['contest_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $invite = Invite::where('email', $user['email']);

        if(count($invite->get()) > 0) {
            $check = $invite->get()->first();
            if($check['isValidated'] != 1 && $check['hasExtraPoints'] != 1) {
                $invite->update([
                    'isValidated' => 1,
                    'hasExtraPoints' => 1
                ]);

                ContestPhotos::where('user_id', $check['user_id'])->orderBy('created_at', 'asc')->get()->first()->increment('likes', 5);
            }
        }

        return $user;
    }
}
