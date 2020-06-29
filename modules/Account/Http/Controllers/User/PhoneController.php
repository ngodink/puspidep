<?php

namespace Modules\Account\Http\Controllers\User;

use Illuminate\Http\Request;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\User\Phone\UpdateRequest;

class PhoneController extends Controller
{
    /**
     * index.
     */
    public function index()
    {
    	$user = auth()->user();

        $this->authorize('update', $user);

        return view('account::user.phone.edit', compact('user'));
    }

    /**
     * Update data.
     */
    public function update(UpdateRequest $request)
    {
        $user = auth()->user();

        $this->authorize('update', $user);

        $data = $request->validated();
        $data['whatsapp'] = (bool) $request->input('whatsapp');

        if ($user->phone()->updateOrCreate(['user_id' => $user->id], $data)) {

            return redirect($request->get('next', route('account::index')))
                        ->with(['success' => 'Sukses, nomor HP telah berhasil diperbarui.']);

        }

        return redirect()->back()
                         ->withInput()
                         ->with(['danger' => 'Maaf, terjadi kegagalan ketika proses penyimpanan.']);
    }
}
