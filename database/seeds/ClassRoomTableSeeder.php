<?php

use Illuminate\Database\Seeder;

class ClassRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $classrooms = [
            [
                'name'=>'Phong 1'
            ],
            [
                'name'=>'Phong 2'
            ],
            [
                'name'=>'Phong 3'
            ],
            [
                'name'=>'Phong 4'
            ]
        ];
        foreach ($classrooms as $classroom)
        {
            \App\Classroom::create($classroom);
        }
    }
}
