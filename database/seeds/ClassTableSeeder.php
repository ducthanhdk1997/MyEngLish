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
        $grades = \App\Grade::all();
        foreach ($grades as $grade){
            $newClass = [
                "name" => "lop " . $grade->name,
                "grade_id" => $grade->id,
            ];
            \App\Classes::create($newClass);
        }

    }
}
