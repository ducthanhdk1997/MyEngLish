<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'name' => 'Toeic01_CB_01',
                'course_id' => 1,
                'teacher_id' =>4,
            ],
            [
                'name' => 'Toeic01_NC_02',
                'course_id' => 1,
                'teacher_id' =>105,
            ],
            [
                'name' => 'Toeic02_NC_01',
                'course_id' => 2,
                'teacher_id' =>106,
            ],
            [
                'name' => 'Toeic02_CB_01',
                'course_id' => 2,
                'teacher_id' =>107,
            ],
            [
                'name' => 'Ielts01_NC_01',
                'course_id' =>5,
                'teacher_id' =>108,
            ],
            [
                'name' => 'Ielts01_CB_01',
                'course_id' =>5,
                'teacher_id' =>109,
            ],
            [
                'name' => 'Ielts02_NC_01',
                'course_id' =>6,
                'teacher_id' =>110,
            ],
            [
                'name' => 'Ielts02_CB_01',
                'course_id' =>6,
                'teacher_id' =>111,
            ],
            [
                'name' => 'Com01_CB_01',
                'course_id' =>3,
                'teacher_id' =>112,
            ],
            [
                'name' => 'Com01_CB_02',
                'course_id' =>3,
                'teacher_id' =>113,
            ],
            [
                'name' => 'Com02_CB_01',
                'course_id' =>4,
                'teacher_id' =>114,
            ],
            [
                'name' => 'Com02_CB_02',
                'course_id' =>4,
                'teacher_id' =>115,
            ],
            [
                'name' => 'Basic_CB_01',
                'course_id' =>7,
                'teacher_id' =>116,
            ],
            [
                'name' => 'Basic_CB_02',
                'course_id' =>7,
                'teacher_id' =>117,
            ]

        ];
        foreach ($classes as $class)
        {
            \App\Classes::create($class);
        }
    }
}
