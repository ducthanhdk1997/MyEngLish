<?php

use Illuminate\Database\Seeder;

class StyleExersiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $styles = [
            [
                'name'=>'day'
            ],
            [
                'name'=>'test'
            ]
        ];
        foreach ($styles as $style)
        {
            \App\Style_Exercise::create($style);
        }
    }
}
