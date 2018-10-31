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

        $grades = \App\Grade::all();
        $styles = \App\Style_Exercise::all();
        $names = ['Bai1'=>0,'Bai2'=>1,'Bai3'=>2,'Bai4'=>3];
        foreach ($grades as $grade)
        {
            foreach ($styles as $style){
                $newExer = [
                    'name' => array_rand($names),
                    'grade_id' => $grade->id,
                    'style_id' => $style->id,
                    'num_part' => 1
                ];
                $newExer = \App\Exercise::create($newExer);
            }
        }





    }
}
