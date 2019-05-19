<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $courses = [
            [
              'name'=>"Khóa học toeic đợt 1",
              'start_date' =>Carbon::parse('2019-03-11'),
              'end_date' =>Carbon::parse('2019-03-11')->addWeek(15)->subDay(1),
              'describe' =>'Khóa học giúp bạn đạt tối thiểu 500 toeic',
              'price'=>5000000,
            ],
            [
                'name'=>"Khóa học toeic đợt 2",
                'start_date' =>Carbon::parse('2019-05-06'),
                'end_date' =>Carbon::parse('2019-05-06')->addWeek(15)->subDay(1),
                'describe' =>'Khóa học giúp bạn đạt tối thiểu 500 toeic',
                'price'=>5300000,
            ],
            [
                'name'=>"Khóa học IELTS 1",
                'start_date' =>Carbon::parse('2019-05-27'),
                'end_date' =>Carbon::parse('2019-05-27')->addWeek(15)->subDay(1),
                'describe' =>'Khóa học giúp bạn đạt 7.0 IELTS',
                'price'=>5300000,
            ],


        ];
        foreach ($courses as $course)
        {
            \App\Course::create($course);
        }
    }
}
