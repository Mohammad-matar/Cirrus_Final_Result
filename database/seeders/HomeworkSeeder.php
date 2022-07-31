<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homework')->insert([
            'teacher_id' => 1,
            'title' => 'homework 1 ',
            'content' => 'this is the content of homework 1',
        ]);
    }
}
