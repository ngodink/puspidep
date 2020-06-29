<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\Password\UpdateRequest;

class PasswordController extends Controller
{
    /**
     * index.
     */
    public function index()
    {
    	$user = auth()->user();

        $this->authorize('update', $user);

        return view('account::password', compact('user'));
    }

    /**
     * Update data.
     */
    public function update(UpdateRequest $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $user->updatePassword($request->input('password'));

        return redirect($request->get('next', route('account::index')))
                    ->with(['success' => 'Sukses, sandi telah berhasil diperbarui.']);
    }
}
