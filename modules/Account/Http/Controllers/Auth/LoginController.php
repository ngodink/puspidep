<?php

namespace Modules\Account\Http\Controllers\Auth;

use Modules\Account\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect(request('next', RouteServiceProvider::HOME));
    }

    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('account::auth.login');
    }

    /**
     * Unregistered.
     */
    public function unregistered()
    {
        return view('account::auth.unregistered');
    }

    /**
     * Show the application's login form.
     */
    public function index()
    {
        return $this->showLoginForm();
    }

    /**
     * Get the login username to be used by the controller.
     */
    public function username()
    {
        return 'username';
    }

    /**
     * The user has logged out of the application.
     */
    protected function loggedOut(Request $request)
    {
        return redirect(request('next', config('app.url')));
    }
}
