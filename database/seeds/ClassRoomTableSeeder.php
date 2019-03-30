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
            ],
            [
                'name'=>'Phong 5'
            ],
            [
                'name'=>'Phong 6'
            ],
            [
                'name'=>'Phong 7'
            ],
            [
                'name'=>'Phong 8'
            ],
            [
                'name'=>'Phong 9'
            ],
            [
                'name'=>'Phong 10'
            ]
        ];
        foreach ($classrooms as $classroom)
        {
            \App\Classroom::create($classroom);
        }
    }
}
