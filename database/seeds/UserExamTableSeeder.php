<?php

use Illuminate\Database\Seeder;

class UserExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $classes =  \App\Classes::query()->where('course_id' ,'=',1)->get();
        foreach ( $classes as $class)
        {
            $studens = \App\User_Class::query()->where('class_id','=',$class->id)->get();
            foreach ($studens as $studen)
            {
                $user_exam = [
                    'user_id' => $studen->user_id,
                    'exam_id' => 1
                ];
                \App\UserExam::create($user_exam);
            }
        }

        $exams = \App\Exam::query()->where('id','!=',1)->get();
        foreach ($exams as $indexExam => $exam)
        {
            for($i = ($indexExam+1)*65;$i<= ($indexExam+1)*65+60;$i++)
            {
                $user_exam = [
                    'user_id' => $i,
                    'exam_id' => $exam->id
                ];
                \App\UserExam::create($user_exam);
            }
        }
    }
}
