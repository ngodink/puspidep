<?php

namespace Modules\Web\Http\Controllers\Admin;

use Modules\Account\Models\User;
use Modules\Account\Models\UserProfile;
use Modules\Account\Models\Role;
use Modules\Web\Http\Requests\Admin\User\StoreRequest;
use Modules\Web\Http\Requests\Admin\User\UpdateRequest;

use Illuminate\Http\Request;
use Modules\Web\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    	$users = User::search($request->get('search'))->when($request->get('role'), function ($query, $v) {
    		return $query->whereHas('roles', function ($role) use ($v) {
                return $role->where('id', $v);
            });
    	})->when($request->get('trashed'), function ($query, $v) {
    		return $query->onlyTrashed();
    	})->orderByDesc('created_at')->paginate($request->get('limit', 10));

        $roles = Role::whereNotIn('id', [1])->get();

        return view('web::admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    	$roles = Role::whereNotIn('id', [1])->get();

    	return view('web::admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $password = User::generatePassword();
        $data = $request->validated();

        $user = new User([
            'username' => strtolower($data['username']),
            'password' => bcrypt($password),
        ]);

        $user->save();

        $profile = new UserProfile([
            'name' => $data['name'],
            'bio'  => $data['bio']
        ]);

        $user->profile()->save($profile);
        $user->roles()->sync($request->input('roles'));

        auth()->user()->log('Membuat pengguna <strong>'.$user->profile->name.'</strong>');

        return redirect($request->get('next', route('web::admin.users.index')))
                    ->with('success', 'Pengguna <strong>'.$user->profile->name.' ('.$user->username.')</strong> berhasil dibuat dengan sandi <strong>'.$password.'</strong>');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    	$roles = Role::whereNotIn('id', [1])->get();

    	return view('web::admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user = $user->fill([
            'username'          => strtolower($request->input('username'))
        ]);

        $user->save();

        $user->profile()->update([
            'name'              => $request->input('name'),
            'bio'              => $request->input('bio')
        ]);
        $user->roles()->sync($request->input('roles'));

        auth()->user()->log('Mengubah pengguna <strong>'.$user->profile->name.'</strong>');

        return redirect($request->get('next', route('web::admin.users.index')))
                    ->with('success', 'Pengguna <strong>'.$user->profile->name.' ('.$user->username.')</strong> berhasil diperbarui');
    }

    /**
     * Reset password the specified resource from storage.
     */
    public function repass(User $user)
    {
        $password = User::generatePassword();

        $user->update([
            'password' => bcrypt($password)
        ]);

        auth()->user()->log('Mengubah sandi <strong>'.$user->profile->name.'</strong>');

        return redirect(request('next', route('web::admin.users.index')))
                    ->with('success', 'Sandi pengguna <strong>'.$user->profile->name.' ('.$user->username.')</strong> berhasil diperbarui menjadi <strong>'.$password.'</strong>');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(request('next', route('web::admin.users.index')))
                    ->with('success', 'Pengguna <strong>'.$user->profile->name.' ('.$user->username.')</strong> berhasil dibuang!');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(User $user)
    {
        $user->restore();

        return redirect(request('next', route('web::admin.users.index')))
                    ->with('success', 'Pengguna <strong>'.$user->profile->name.' ('.$user->username.')</strong> berhasil dipulihkan!');
    }

    /**
     * Kill the specified resource from storage.
     */
    public function kill(User $user)
    {
        $tmp_name = $user->profile->name;
        $tmp_username = $user->username;

        $user->forceDelete();

        return redirect(request('next', route('web::admin.users.index')))
                    ->with('success', 'Pengguna <strong>'.$tmp_name.' ('.$tmp_username.')</strong> berhasil dihapus secara permanen!');
    }
}
