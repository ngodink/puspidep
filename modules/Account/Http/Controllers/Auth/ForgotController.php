<?php

namespace Modules\Account\Http\Controllers\Auth;

use Modules\Account\Models\User;
use Modules\Account\Rules\VerifiedEmail;
use Modules\Account\Notifications\Auth\ForgotPasswordNotification;

use Illuminate\Http\Request;
use Modules\Account\Http\Controllers\Controller;

class ForgotController extends Controller
{
    /**
     * Time expiration for password reset.
     */
    protected $expiration = 1;

    /**
     * Display the form to request a password reset link.
     */
    public function index()
    {
        return view('account::auth.forgot');
    }

    /**
     * Send password broker link.
     */
    public function send(Request $request)
    {
        $data = $request->validate($this->validator());

        if ($this->attempt($data)) {

            return redirect()->route('account::auth.login')
                             ->with(['success' => 'Sukses, kami telah mengirimkan tautan pengaturan ulang sandi ke alamat e-mail Anda, masa berlaku tautan adalah '.$this->expiration.' hari.']);
        }

        return redirect()->back()
                         ->withInput()
                         ->withErrors(['email' => 'Maaf, alamat e-mail tidak valid atau belum diverifikasi.']);
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
            'email'   => ['required', 'string', 'email', 'exists:user_emails,address', new VerifiedEmail],
        ];
    }

    /**
     * Send password broker link.
     */
    public function attempt(array $data)
    {
        if ($user = User::whereEmail($data['email'])->first()) {

            $broker = $this->generateBroker();

            $user->broker()->updateOrCreate([], $broker);

            $this->sendForgotPasswordNotification($user, $broker['token']);

            return true;
        }

        return false;
    }

    /**
     * Send to email.
     */
    public function sendForgotPasswordNotification(User $user, $token)
    {
        $link = route('account::auth.broker', ['token' => $token]);

        $user->notify(new ForgotPasswordNotification($link));

        return true;
    }

    /**
     * Genereate broker and expiring date.
     */
    public function generateBroker()
    {
        return [
            'token' => \Str::random(64),
            'expired_in' => (time() + (60 * 60 * 24 * $this->expiration))
        ];
    }
}
