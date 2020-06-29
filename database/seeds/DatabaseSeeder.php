<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\Account\Database\Seeders\AccountDatabaseSeeder::class);
        $this->call(\Modules\Web\Database\Seeders\WebDatabaseSeeder::class);
    }
}
