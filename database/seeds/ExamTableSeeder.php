<?php

use Illuminate\Database\Seeder;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $courses = \App\Course::all();
        foreach ($courses as $index => $course)
        {
            $exam = \App\Exam::create([
                'title' => 'Lịch thi cho khóa học'. $course->name,
                'shift_id' => 6,
                'classroom_id' => 1,
                'course_id' => $course->id,
                'start_date' => \Carbon\Carbon::parse($course->start_date)->subWeek()->subDay(),
                'deadline' => \Carbon\Carbon::parse($course->start_date)->subWeek(2)->subDay(1),
                'state' =>  \Carbon\Carbon::parse($course->start_date)->subWeek()->subDay()->isPast() ? 1 : 0,
            ]);
        }

    }
}
