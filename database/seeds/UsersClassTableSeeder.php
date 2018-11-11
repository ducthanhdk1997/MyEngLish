<?php

use Illuminate\Database\Seeder;

class UsersClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = \App\Classes::all();
        $users = \App\User::query()->where('role_id', 4)->get();
        foreach ($classes as $class) {
            foreach ($users as $user) {

                \App\User_Class::query()->create([
                    'class_id' => $class->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}