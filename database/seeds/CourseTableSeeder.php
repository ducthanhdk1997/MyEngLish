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
              'name'=>"Khoa hoc A1 dot 1",
              'time_start' =>Carbon::parse('2018-10-01'),
              'time_end' =>Carbon::parse('2019-01-01'),
              'actua_end_date'=>Carbon::parse('2019-01-09'),
              'describe' =>'Khóa học dành cho các bạn muốn đạt trình độ A1',
              'price'=>5000000,
              'grade_id'=>1
            ],
            [
                'name'=>"Khoa hoc A2 dot 1",
                'time_start' =>Carbon::parse('2018-10-01'),
                'time_end' =>Carbon::parse('2019-01-01'),
                'actua_end_date'=>Carbon::parse('2019-01-09'),
                'describe' =>'Khóa học dành cho các bạn muốn đạt trình độ A2',
                'price'=>5300000,
                'grade_id'=>2
            ],
            [
                'name'=>"Khoa hoc B1 dot 1",
                'time_start' =>Carbon::parse('2018-10-01'),
                'time_end' =>Carbon::parse('2019-01-01'),
                'actua_end_date'=>Carbon::parse('2019-01-09'),
                'describe' =>'Khóa học dành cho các bạn muốn đạt trình độ B1',
                'price'=>5600000,
                'grade_id'=>3
            ]
            [
                'name'=>"Khoa hoc Toeic dot 1",
                'time_start' =>Carbon::parse('2018-10-01'),
                'time_end' =>Carbon::parse('2019-01-01'),
                'actua_end_date'=>Carbon::parse('2019-01-09'),
                'describe' =>'Khóa học dành cho các bạn muốn đạt trình độ Toeic',
                'price'=>5600000,
                'grade_id'=>4
            ],
            [
                'name'=>"Khoa hoc Ielts dot 1",
                'time_start' =>Carbon::parse('2018-10-01'),
                'time_end' =>Carbon::parse('2019-01-01'),
                'actua_end_date'=>Carbon::parse('2019-01-09'),
                'describe' =>'Khóa học dành cho các bạn muốn đạt trình độ Ielts',
                'price'=>5600000,
                'grade_id'=>5
            ]

        ];
        foreach ($courses as $course)
        {
            \App\Course::create($course);
        }
    }
}
