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
                'name'=>'Phòng 1'
            ],
            [
                'name'=>'Phòng 2'
            ],
            [
                'name'=>'Phòng 3'
            ],
            [
                'name'=>'Phòng 4'
            ],
            [
                'name'=>'Phòng 5'
            ],
            [
                'name'=>'Phòng 6'
            ],
            [
                'name'=>'Phòng 7'
            ],
            [
                'name'=>'Phòng 8'
            ],
            [
                'name'=>'Phòng 9'
            ],
            [
                'name'=>'Phòng 10'
            ]
        ];
        foreach ($classrooms as $classroom)
        {
            \App\Classroom::create($classroom);
        }
    }
}
