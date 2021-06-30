<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Photo;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo_id' => ['sometimes', 'image', 'mimes:jpg,jpeg,png,svg', 'max:3000']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        if (request()->has('photo_id')) {
            $file = request()->file('photo_id');
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'photo_id' => $photo->id,
               /* DB::table('user_role')->insert([
                    'role_id' => '2',

                 ])->withTimestamps(),*/
                 Mail::to($data['email'])->send(new WelcomeMail())
            ])/*->roles()->attach('2')*/; //login probleem maar data komt wel in DB

        } else {

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                 Mail::to($data['email'])->send(new WelcomeMail())
            ])/*->roles()->attach(2)*/ ;

        }

    }
}
