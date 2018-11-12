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
                'name'=> 'A1_N01',
                'grade_id' => '1',
                'user_id' => 4,
            ],
            [
                'name'=> 'A1_N02',
                'grade_id' => '1',
                'user_id' => 6,
            ],
            [
                'name'=> 'A1_N03',
                'grade_id' => '1',
                'user_id' => 8,
            ],
            [
                'name'=> 'A2_N01',
                'grade_id' => '2',
                'user_id' => 13,
            ],
            [
                'name'=> 'A2_N02',
                'grade_id' => '2',
                'user_id' => 16,
            ],
            [
                'name'=> 'A2_N03',
                'grade_id' => '2',
                'user_id' => 18,
            ],
            [
                'name'=> 'B1_N01',
                'grade_id' => '3',
                'user_id' => 20,
            ],
            [
                'name'=> 'B1_N02',
                'grade_id' => '3',
                'user_id' => 21,
            ],
            [
                'name'=> 'B1_N03',
                'grade_id' => '3',
                'user_id' => 23,
            ],
            [
                'name'=> 'Toeic_N01',
                'grade_id' => '4',
                'user_id' => 26,
            ],
            [
                'name'=> 'Toeic_N02',
                'grade_id' => '4',
                'user_id' => 31,
            ],
            [
                'name'=> 'Toeic_N03',
                'grade_id' => '4',
                'user_id' => 32,
            ],
            [
                'name'=> 'Ielts_N01',
                'grade_id' => '5',
                'user_id' => 35,
            ],
            [
                'name'=> 'Ielts_N02',
                'grade_id' => '5',
                'user_id' => 49,
            ],
            [
                'name'=> 'Ielts_N03',
                'grade_id' => '5',
                'user_id' => 51,
            ],
        ];
        foreach ($classes as $class)
        {
            \App\Classes::create($class);
        }
    }
}
