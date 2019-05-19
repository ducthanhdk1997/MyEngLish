<?php

use Illuminate\Database\Seeder;

class ClassSessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $exam1 = factory(\App\Class_Session::class,50)->state('unfinish1')->create();
//        $exam3 = factory(\App\Class_Session::class,50)->state('finish1')->create();

        $schedules = \App\Schedule_Class::all();

        foreach ($schedules as  $schedule) {
            $startDate = \Carbon\Carbon::parse($schedule->start_date);
            $endDate = \Carbon\Carbon::parse($schedule->end_date);
            $weekday = $schedule->weekday;
            $ngaychenhlech = ($weekday - $startDate->dayOfWeek);
            if ($ngaychenhlech < 0) {
                $ngaychenhlech += 7;
            }
            $firstDayStudy = (clone $startDate)->addDay($ngaychenhlech);

            for ($monday = $firstDayStudy; $monday->lessThanOrEqualTo($endDate); $monday->addWeek())
            {
                $start = clone $monday;

                \App\Class_Session::create([
                    'start_date' => $start->toDateString(),
                    'state' => $start->isPast() ? 1 : 0,
                    'shift_id' => 1,
                    'classroom_id' => 1,
                    'class_id' => $schedule->class_id,
                    'schedule_id' => $schedule->id
                ]);


            }


        }
    }
}
