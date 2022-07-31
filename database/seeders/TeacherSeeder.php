<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'name' => 'Zaynab',
            'email' => 'zaynab.abdelnabi@gmail.com',
            'password' => 'zaynabzaynab',
            'date_of_birth' =>  Carbon::create('2000', '01', '01'),
            'phone_number' => '81286345',
            'gender' => 'female',
        ]);
    }
}
