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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class );
        $this->call(CourseTableSeeder::class);
        $this->call(ClassTableSeeder::class);
        $this->call(UsersClassTableSeeder::class);
        $this->call(ClassRoomTableSeeder::class);
        $this->call(VoucherTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(ExamTableSeeder::class);


    }
}
