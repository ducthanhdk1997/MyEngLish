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
        $users =[
            [
                'username'=>'admin',
                'email'=>'root@gmail.com',
                'password'=>bcrypt('abc123'),
                'avatar'=>'admin.png',
                'address'=>'Ha Noi',
                'gender'=>0,
                'level' =>'Quản trị',
                'phone'=> '0326196129',
                'role_id' =>1,
                'facebook'=>'https://www.facebook.com/nguyenthanhat1997'
            ],
            [
                'username'=>'Nguyễn Đức Thành',
                'email'=>'thanhducbnutc@gmail.com',
                'password'=>bcrypt('abc123'),
                'avatar'=>'admin.png',
                'address' =>'Ha Noi',
                'gender'=>0,
                'level' =>'Thạc sĩ',
                'phone'=> '0326196129',
                'role_id' =>3,
                'facebook'=>'https://www.facebook.com/nguyenthanhat1997'
            ],
            [
                'username'=>'Nguyễn Đức Thành',
                'email'=>'thanh@gmail.com',
                'password'=>bcrypt('abc123'),
                'avatar'=>'admin.png',
                'address' =>'Ha Noi',
                'gender'=>0,
                'level' =>'Thạc sĩ',
                'phone'=> '0326196129',
                'role_id' =>4,
                'facebook'=>'https://www.facebook.com/nguyenthanhat1997'
            ]
        ];

        foreach ($users as $user)
        {
            \App\User::create($user);
        }

        $user = factory(App\User::class, 420)->states('students')->create();
        $userss = factory(App\User::class, 30)->states('teachers')->create();


    }
}
