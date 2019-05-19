<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $schedule_classes = [
            [

                'start_date' =>Carbon::parse('2019-03-11'),
                'end_date' =>Carbon::parse('2019-03-11')->addWeek(15)->subDay(1),
                'class_id' => 1,
                'classroom_id' => 1,
                'weekday' => 1,
                'shift_id' => 1,

            ],
            [
                'start_date' =>Carbon::parse('2019-03-11'),
                'end_date' =>Carbon::parse('2019-03-11')->addWeek(15)->subDay(1),
                'class_id' => 1,
                'classroom_id' => 1,
                'weekday' => 3,
                'shift_id' => 1,
            ],
            [
                'start_date' =>Carbon::parse('2019-03-11'),
                'end_date' =>Carbon::parse('2019-03-11')->addWeek(15)->subDay(1),
                'class_id' => 2,
                'classroom_id' => 1,
                'weekday' => 2,
                'shift_id' => 1,
            ],
            [
                'start_date' =>Carbon::parse('2019-03-11'),
                'end_date' =>Carbon::parse('2019-03-11')->addWeek(15)->subDay(1),
                'class_id' => 2,
                'classroom_id' => 1,
                'weekday' => 4,
                'shift_id' => 1,
            ],


        ];
        foreach ($schedule_classes as $schedule_class)
        {
            \App\Schedule_Class::create($schedule_class);
        }
    }
}
