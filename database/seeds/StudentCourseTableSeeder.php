<?php

use Illuminate\Database\Seeder;

class StudentCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $classes = \App\Classes::all();
        foreach ($classes as $class)
        {
            $course_id = $class->course->id;
            $price = $class->course->price;
            $class_users = \App\User_Class::query()->where('class_id','=',$class->id)->get();
            foreach ($class_users as $class_user)
            {
                $user_course = [
                    'user_id' => $class_user->user_id,
                    'state' => 1,
                    'total_amount' => $price,
                    'voucher_id' => null,
                    'course_id' => $course_id
                ];
                $s = \App\User_Course::query()->create($user_course);
            }
        }
    }
}
