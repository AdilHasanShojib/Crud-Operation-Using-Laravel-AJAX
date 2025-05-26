<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HRMSEmployeeTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('hrms_employee_types')->insert([
            ['Type_Name' => 'Permanent', 'Status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['Type_Name' => 'Contract', 'Status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['Type_Name' => 'Intern', 'Status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

