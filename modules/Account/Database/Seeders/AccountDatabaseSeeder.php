<?php

namespace Modules\Account\Database\Seeders;

use Modules\Account\Models\User;
use Modules\Account\Models\Role;
use Modules\Account\Models\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AccountDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(\Modules\Account\Models\User::class, 20)->create()->each(function ($user) {
            $user->profile()->save(factory(\Modules\Account\Models\UserProfile::class)->make());
        });

        $permissions = [
            'update-username',
            'store-user',
            'view-user',
            'update-user',
            'remove-user',
            'delete-user',
            'assign-user-roles',
            'assign-user-permissions',
            'store-role',
            'update-role',
            'delete-role',
        ];

        foreach ($permissions as $perm) {
            Permission::create([
                'name' => $perm,
                'module' => 'account'
            ]);
        }

        $role = Role::create([
            'name' => 'root'
        ]);

        $role->permissions()->attach(Permission::all()->pluck('id'));

        $user = User::all()->first()->roles()->attach($role);
    }
}