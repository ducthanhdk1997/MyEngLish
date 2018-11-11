<?php

use Illuminate\Database\Seeder;

class ClassCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $class_courses = [
            [
                'class_id'=> '1',
                'course_id' => '1'
            ],
            [
                'class_id'=> '2',
                'course_id' => '1'
            ],
            [
                'class_id'=> '3',
                'course_id' => '1'
            ],
            [
                'class_id'=> '4',
                'course_id' => '2'
            ],
            [
                'class_id'=> '5',
                'course_id' => '2'
            ],
            [
                'class_id'=> '6',
                'course_id' => '2'
            ],
            [
                'class_id'=> '7',
                'course_id' => '3'
            ],
            [
                'class_id'=> '8',
                'course_id' => '3'
            ],
            [
                'class_id'=> '9',
                'course_id' => '3'
            ],
            [
                'class_id'=> '10',
                'course_id' => '4'
            ],
            [
                'class_id'=> '11',
                'course_id' => '4'
            ],
            [
                'class_id'=> '12',
                'course_id' => '4'
            ],
            [
                'class_id'=> '13',
                'course_id' => '5'
            ],
            [
                'class_id'=> '14',
                'course_id' => '5'
            ],
            [
                'class_id'=> '15',
                'course_id' => '5'
            ],
        ];
        foreach ($class_courses as $class_cours)
        {
            \App\Class_Course::create($class_cours);
        }
    }
}
