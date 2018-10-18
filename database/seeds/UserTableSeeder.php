<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =[
            'username'=>'admin',
            'email'=>'nguyenthanhat1997@gmail.com',
            'password'=>bcrypt('12345'),
            'avatar'=>'admin.png',
            'gender'=>0,
            'phone'=> '0326196129',

        ];

        \App\User::create($user);
        $user = factory(App\User::class,100)->create();
    }
}
