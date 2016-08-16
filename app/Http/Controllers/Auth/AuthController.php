<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username = 'name';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255|alpha_num',
            'fullname' => 'required|max:255',
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:255',
            'company_email' => 'required|email|max:255|unique:companies',
            'sex' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        $company = Company::create([
            'company_name' => $data['company_name'],
            'company_address' => $data['company_address'],
            'company_email' => $data['company_email']
        ]);
        $success = User::create([
            'name' => $data['name'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'group_id' => 2,
            'company_id' => $company->id,
            'password' => bcrypt($data['password']),
        ]);
        if ($success) {
            DB::commit();
        } else {
            DB::rollback();
        }
        return $success;
    }
}
