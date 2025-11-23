<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(BreaktimesTableSeeder::class);
        $this->call(CorrectionsTableSeeder::class);
        $this->call(CorrectionBreaksTableSeeder::class);
        $this->call(BeforeCorrectionsTableSeeder::class);
        $this->call(BeforeBreaksTableSeeder::class);
    }
}
