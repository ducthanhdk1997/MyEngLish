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
                'state' => false,
                'teacher_id' =>2,
            ],
            [
                'name' => 'Toeic01_NC_02',
                'course_id' => 1,
                'state' => false,
                'teacher_id' =>453,
            ],

        ];
        foreach ($classes as $class)
        {
            \App\Classes::create($class);

        }
    }
}
