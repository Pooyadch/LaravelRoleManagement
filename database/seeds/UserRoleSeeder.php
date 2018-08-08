<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Pooyadch\LaravelRoleManagement\UserRolePermission::class, 20)->create();
    }
}
