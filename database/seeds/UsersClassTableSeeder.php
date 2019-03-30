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
        $users = \App\User::query()->where('role_id', 3)->get();
        foreach ($classes  as $classIndex=> $class) {
            foreach ($users as $userIndex =>  $user) {
                if($classIndex*30 <= $userIndex && $userIndex < ($classIndex+1)*30)
                {
                    \App\User_Class::query()->create([
                        'class_id' => $class->id,
                        'user_id' => $user->id,
                    ]);
                }

            }
        }
    }
}