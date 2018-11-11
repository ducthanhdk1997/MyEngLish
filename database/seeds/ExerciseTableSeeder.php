<?php

use Illuminate\Database\Seeder;

class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = [
            [
                'name'=> 'Bai1',
                'grade_id' => '1'
            ],
            [
                'name'=> 'Bai2',
                'grade_id' => '1'
            ],
            [
                'name'=> 'Bai3',
                'grade_id' => '1'
            ],
            [
                'name'=> 'Bai1',
                'grade_id' => '2'
            ],
            [
                'name'=> 'Bai2',
                'grade_id' => '2'
            ],
            [
                'name'=> 'Bai3',
                'grade_id' => '2'
            ],
            [
                'name'=> 'Bai1',
                'grade_id' => '3'
            ],
            [
                'name'=> 'Bai2',
                'grade_id' => '3'
            ],
            [
                'name'=> 'Bai3',
                'grade_id' => '3'
            ],
            [
                'name'=> 'Bai1',
                'grade_id' => '4'
            ],
            [
                'name'=> 'Bai2',
                'grade_id' => '4'
            ],
            [
                'name'=> 'Bai3',
                'grade_id' => '4'
            ],
            [
                'name'=> 'Bai1',
                'grade_id' => '5'
            ],
            [
                'name'=> 'Bai2',
                'grade_id' => '5'
            ],
            [
                'name'=> 'Bai3',
                'grade_id' => '5'
            ],
        ];
        foreach ($exercises as $exercise)
        {
            \App\Exercise::create($exercise);
        }
    }
}
