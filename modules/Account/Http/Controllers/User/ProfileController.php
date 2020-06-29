<?php

namespace Modules\Account\Http\Controllers\User;

use Illuminate\Http\Request;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\User\Profile\UpdateRequest;

class ProfileController extends Controller
{
    /**
     * index.
     */
    public function index()
    {
    	$user = auth()->user();
        
        $this->authorize('update', $user);

        return view('account::user.profile.edit', compact('user'));
    }

    /**
     * Update data.
     */
    public function update(UpdateRequest $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $data = $request->validated();
        $data['dob'] = date('Y-m-d', strtotime($data['dob']));

        if ($user->profile()->update($data)) {

            return redirect($request->get('next', route('account::index')))
                        ->with(['success' => 'Sukses, profil telah berhasil diperbarui.']);

        }

        return redirect()->back()
                         ->withInput()
                         ->with(['danger' => 'Maaf, terjadi kegagalan ketika proses penyimpanan.']);
    }
}
