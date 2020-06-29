<?php

namespace Modules\Account\Http\Controllers\Auth;

use Modules\Account\Models\UserPasswordReset;

use Illuminate\Http\Request;
use Modules\Account\Http\Controllers\Controller;

class BrokerController extends Controller
{

    /**
     * Display the password reset view for the given token.
     */
    public function index()
    {
        return view('account::auth.broker')->with([
                    'token' => request('token')
                ]);
    }

    /**
     * Break the user password.
     */
    public function broke(Request $request)
    {
        $request->validate($this->validator());

        if ($this->attemptBroke($request->only(['token', 'password']))) {

            return redirect()->route('account::auth.login')
                             ->with(['success' => 'Sukses, password telah berhasil dirubah.']);

        }

        return redirect()->route('account::auth.login')
                         ->with(['danger' => 'Mohon maaf, terjadi kegagalan, token telah kadaluarsa.']);
    }

    /**
     * --------------------------------------------------
     * --------------------------------------------------
     * --------------------------------------------------
     */

    /**
     * Validate the request.
     */
    public function validator()
    {
        return [
            'password'   => 'required|string|min:4|max:191|confirmed',
        ];
    }

    /**
     * Attempt broke.
     */
    public function attemptBroke(array $data)
    {
        if ($broker = UserPasswordReset::where('token', $data['token'])->where('expired_in', '>=', time())->first()) {

            $user = $broker->user->updatePassword($data['password']);
            $broker->delete();

            return $user;
        }

        return false;
    }
}
