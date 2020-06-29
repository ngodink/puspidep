<?php

namespace Modules\Account\Policies;

use Modules\Account\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Can access page.
     */
    public function access(User $user)
    {
        return $user->hasPermissions(['view-user', 'store-user', 'update-user', 'remove-user', 'delete-user']);
    }

    /**
     * Can view.
     */
    public function view(User $user, User $model)
    {
        return $user->id === $model->id || ($user->hasPermissions(['view-user']) && !$model->roles->contains('id', config('account.root_role')));
    }

    /**
     * Can store.
     */
    public function store(User $user)
    {
        return $user->hasPermissions(['store-user']);
    }

    /**
     * Can update.
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id || ($user->hasPermissions(['update-user']) && !$model->roles->contains('id', config('account.root_role')));
    }

    /**
     * Can remove.
     */
    public function remove(User $user, User $model)
    {
        return ($user->hasPermissions(['remove-user']) && !$model->roles->contains('id', config('account.root_role')));
    }

    /**
     * Can delete.
     */
    public function delete(User $user, User $model)
    {
        return ($user->hasPermissions(['delete-user']) && !$model->roles->contains('id', config('account.root_role')));
    }

    /**
     * Can update username.
     */
    public function updateUsername(User $user)
    {
        return $user->hasPermissions(['update-username', 'update-user']);
    }

    /**
     * Can assign user roles.
     */
    public function assignUserRoles(User $user)
    {
        return $user->hasPermissions(['assign-user-roles']);
    }
}