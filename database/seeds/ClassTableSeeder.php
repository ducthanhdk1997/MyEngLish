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
        //
        $classes = [
            [
                'name'=> 'A1_N01',
                'grade_id' => '1'
            ],
            [
                'name'=> 'A1_N02',
                'grade_id' => '1'
            ],
            [
                'name'=> 'A1_N03',
                'grade_id' => '1'
            ],
            [
                'name'=> 'A2_N01',
                'grade_id' => '2'
            ],
            [
                'name'=> 'A2_N02',
                'grade_id' => '2'
            ],
            [
                'name'=> 'A2_N03',
                'grade_id' => '2'
            ],
            [
                'name'=> 'B1_N01',
                'grade_id' => '3'
            ],
            [
                'name'=> 'B1_N02',
                'grade_id' => '3'
            ],
            [
                'name'=> 'B1_N03',
                'grade_id' => '3'
            ],
            [
                'name'=> 'Toeic_N01',
                'grade_id' => '4'
            ],
            [
                'name'=> 'Toeic_N02',
                'grade_id' => '4'
            ],
            [
                'name'=> 'Toeic_N03',
                'grade_id' => '4'
            ],
            [
                'name'=> 'Ielts_N01',
                'grade_id' => '5'
            ],
            [
                'name'=> 'Ielts_N02',
                'grade_id' => '5'
            ],
            [
                'name'=> 'Ielts_N03',
                'grade_id' => '5'
            ],
        ];
        foreach ($classes as $class)
        {
            \App\Classes::create($class);
        }
    }
}
