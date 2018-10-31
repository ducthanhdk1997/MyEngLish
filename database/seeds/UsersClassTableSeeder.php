<?php

use Illuminate\Database\Seeder;

class UsersClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vcoid
     */
    public function run()
    {
        $classes = \App\Classes::all();
        $users = \App\User::all();
        $newClassUser = [];
        foreach ($classes as $class){
            foreach ($users as $user)
            {
                $newClassUser[] = [
                    'user_id' => $user->id,
                    'class_id' => $class->id,
                ];
            }
        }
        \Illuminate\Support\Facades\DB::table('user_class')->insert($newClassUser);
    }
}