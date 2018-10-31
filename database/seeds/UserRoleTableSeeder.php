<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_role = [
                'user_id'=>1,
                'role_id'=>1,
        ];

        \App\User_Role::create($user_role);

    }
}
