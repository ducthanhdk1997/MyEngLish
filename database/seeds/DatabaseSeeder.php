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
        $this->call(GradeTableSeeder::class);
        $this->call(ClassRoomTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(StyleExersiceTableSeeder::class);
        $this->call(UsersClassTableSeeder::class);
        $this->call(ExerciseTableSeeder::class);
        $this->call(PartTableSeeder::class);
    }
}
