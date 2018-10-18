<?php

use Illuminate\Database\Seeder;

class GradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $grades = [
            [
                'name'=>'A1'
            ],
            [
                'name'=>'A2'
            ],
            [
                'name'=>'B1'
            ],
            [
                'name'=>'Toeic'
            ],
            [
                'name'=>'Ielts'
            ]
        ];
        foreach ($grades as $grade)
        {
            \App\Grade::create($grade);
        }
    }
}
