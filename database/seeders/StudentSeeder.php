<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'matar',
            'email' => 'moe.matar1998@gmail.com',
            'password' => 'matarov123',
            'date_of_birth' =>  Carbon::create('1998', '01', '01'),
            'phone_number' => '71728733',
            'class' => 'eb7',
            'gender' => 'male',
        ]);
    }
}
