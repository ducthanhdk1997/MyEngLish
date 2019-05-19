<?php

use Illuminate\Database\Seeder;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $shifts = [
            [
                'name' => 'Ca 1',
                'start_time' => \Carbon\Carbon::parse('07:00:00'),
                'end_time' => \Carbon\Carbon::parse('09:00:00')
            ],
            [
                'name' => 'Ca 2',
                'start_time' => \Carbon\Carbon::parse('09:30:00'),
                'end_time' => \Carbon\Carbon::parse('11:30:00')
            ],
            [
                'name' => 'Ca 3',
                'start_time' => \Carbon\Carbon::parse('13:00:00'),
                'end_time' => \Carbon\Carbon::parse('15:00:00')
            ],
            [
                'name' => 'Ca 4',
                'start_time' => \Carbon\Carbon::parse('15:30:00'),
                'end_time' => \Carbon\Carbon::parse('17:30:00')
            ],
            [
                'name' => 'Ca 5',
                'start_time' => \Carbon\Carbon::parse('19:00:00'),
                'end_time' => \Carbon\Carbon::parse('21:00:00')
            ],
            [
                'name' => 'Ca sáng',
                'start_time' => \Carbon\Carbon::parse('07:00:00'),
                'end_time' => \Carbon\Carbon::parse('11:00:00')
            ],
            [
                'name' => 'Ca chiều',
                'start_time' => \Carbon\Carbon::parse('13:00:00'),
                'end_time' => \Carbon\Carbon::parse('17:00:00')
            ],
        ];

        foreach ($shifts as $shift)
        {
            \App\Shift::create($shift);
        }
    }
}
