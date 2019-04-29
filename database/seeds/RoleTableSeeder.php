<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles =[
            [
              'name' => 'Admin'
            ],
            [
                'name'=>'Nhân Viên'
            ],
            [
                "name"=>"Giảng viên"
            ],
            [
                "name"=>"Học sinh"
            ]

        ];
        foreach ($roles as $role)
        {
            \App\Role::create($role);
        }
    }
}
