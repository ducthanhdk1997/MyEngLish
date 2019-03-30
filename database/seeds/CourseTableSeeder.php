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
              'start_date' =>Carbon::parse('2018-03-01'),
              'end_date' =>Carbon::parse('2018-05-01'),
              'describe' =>'Khóa học giúp bạn đạt tối thiểu 500 toeic',
              'price'=>5000000,
            ],
            [
                'name'=>"Khóa học toeic đợt 2",
                'start_date' =>Carbon::parse('2019-04-01'),
                'end_date' =>Carbon::parse('2019-06-01'),
                'describe' =>'Khóa học giúp bạn đạt tối thiểu 500 toeic',
                'price'=>5300000,
            ],
            [
                'name'=>"Khóa học giao tiếp đợt 1",
                'start_date' =>Carbon::parse('2019-3-17'),
                'end_date' =>Carbon::parse('2019-5-17'),
                'describe' =>'Giúp bạn tự tin khi sử dụng tiếng anh để giao tiếp',
                'price'=>5600000,
            ],
            [
                'name'=>"Khóa học giao tiếp đợt 2",
                'start_date' =>Carbon::parse('2019-04-17'),
                'end_date' =>Carbon::parse('2019-06-17'),
                'describe' =>'Giúp bạn tự tin khi sử dụng tiếng anh để giao tiếp',
                'price'=>5600000,
            ]
            ,
            [
                'name'=>"Khóa học Ielts đợt 1",
                'start_date' =>Carbon::parse('2018-03-10'),
                'end_date' =>Carbon::parse('2019-05-10'),
                'describe' =>'Khóa học giúp bạn đạt tối thiểu 5.0 Ielts',
                'price'=>5600000,
            ],

            [
                'name'=>"Khóa học Ielts đợt 2",
                'start_date' =>Carbon::parse('2018-04-01'),
                'end_date' =>Carbon::parse('2019-06-01'),
                'describe' =>'Khóa học giúp bạn đạt tối thiểu 5.0 Ielts',
                'price'=>5600000,
            ],
            [
                'name'=>"Khóa học tiếng anh cơ bản cho người mất gốc đợt 1",
                'start_date' =>Carbon::parse('2018-03-08'),
                'end_date' =>Carbon::parse('2019-06-08'),
                'describe' =>'Giúp bạn đạt những kiến thức cơ bạn về tiếng anh',
                'price'=>5800000,
            ]

        ];
        foreach ($courses as $course)
        {
            \App\Course::create($course);
        }
    }
}
