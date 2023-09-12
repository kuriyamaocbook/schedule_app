<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          \DB::table('schedules')->truncate();

        $obj = new schedule;
        $obj->title = '打ち合わせ';
        $obj->start_time = '2023/05/19 09:00:00';
        $obj->end_time = '2023/05/19 10:00:00';
        $obj->save();
    }
}
