<?php

use Illuminate\Database\Seeder;

class PartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $exercise = \App\Exercise::all();
            foreach ($exercise as $exer)
            {
                $newPart = [
                    'name' => 'Part1',
                    'num_question' =>4,
                    'exercise_id'=>$exer->id,
                ];
                $newExer = \App\Part::create($newPart);

            }
    }
}
