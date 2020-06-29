<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Account\Http\Controllers\Controller;

use Modules\Account\Models\User;
use Modules\Account\Http\Requests\Username\UpdateRequest;

class UsernameController extends Controller
{
    /**
     * index.
     */
    public function index()
    {
    	$user = auth()->user();

        $this->authorize('updateUsername', User::class);

        return view('account::username', compact('user'));
    }

    /**
     * Update data.
     */
    public function update(UpdateRequest $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $user->update($request->only('username'));

        return redirect($request->get('next', route('account::index')))
                    ->with(['success' => 'Sukses, username telah berhasil diperbarui.']);
    }
}
