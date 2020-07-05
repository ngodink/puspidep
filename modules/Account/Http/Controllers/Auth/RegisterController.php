<?php

namespace Modules\Account\Http\Controllers\Auth;

use Modules\Account\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Modules\Account\Models\User;
use Modules\Account\Models\UserProfile;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Show the application's register form.
     */
    public function showRegistrationForm()
    {
        return view('account::auth.register');
    }

    /**
     * Show the application registration form.
     */
    public function index()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'username' => ['required', 'string', 'min:4', 'max:191', 'unique:users', 'regex:/^[a-z\d.]{4,20}$/'],
            'password' => ['required', 'string', 'min:4', 'max:191', 'confirmed'],
        ], [
            'username.unique' => 'Isian :attribute sudah digunakan oleh orang lain, silahkan gunakan :attribute lainnya.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        $user = new User([
            'username' => strtolower($data['username']),
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        $profile = new UserProfile([
            'name' => $data['name'],
        ]);

        $user->profile()->save($profile);
        $user->roles()->sync(5);

        return $user;
    }
}
