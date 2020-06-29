<?php

namespace Modules\Account\Policies;

use Modules\Account\Models\User;
use Modules\Account\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return $user->hasPermissions(['store-role', 'update-role', 'delete-role']);
    }

    /**
     * Can store.
     */
    public function store(User $user)
    {
        return $user->hasPermissions(['store-role']);
    }

    /**
     * Can update.
     */
    public function update(User $user, Role $role)
    {
        return $user->hasPermissions(['update-role']) && !$user->hasRoles([$role->name]) && $role->id != config('account.root_role');
    }

    /**
     * Can delete.
     */
    public function delete(User $user, Role $role)
    {
        return $user->hasPermissions(['delete-role']) && !$user->hasRoles([$role->name]) && $role->id != config('account.root_role');
    }
}