<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HRMSEmployeeDetailsSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('hrms_employee_details')->insert([
                'Employee_UID' => 'EMP' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'EmployeeName' => 'Employee ' . $i,
                'FatherName' => 'Father ' . $i,
                'MotherName' => 'Mother ' . $i,
                'DOB' => Carbon::now()->subYears(rand(20, 40))->subDays(rand(0, 365))->format('Y-m-d'),
                'Gender' => rand(1, 2),
                'Employee_Type_No_FK' => 1,
                'Designation' => 'Designation ' . $i,
                'Contact_Number' => '012345678' . $i,
                'Email_Address' => 'employee' . $i . '@example.com',
                'Remarks' => 'This is employee #' . $i,
                'Status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
