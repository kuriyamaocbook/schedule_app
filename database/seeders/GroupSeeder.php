<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
{
    \DB::table('groups')->truncate();

    $obj = new Group; // 'Group' モデルを使用
    $obj->building = '第1グループ';
    $obj->title = '田中';
    $obj->eventColor = 'blue';
    $obj->save();
}
}
