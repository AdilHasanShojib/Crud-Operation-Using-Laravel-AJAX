<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRMSEmployeeDetail extends Model
{
    use HasFactory;
    protected $table = 'hrms_employee_details';

protected $fillable = [
    'Employee_UID',
    'EmployeeName',
    'FatherName',
    'MotherName',
    'DOB',
    'Gender',
    'Employee_Type_No_FK',
    'Designation',
    'Contact_Number',
    'Email_Address',
    'Remarks',
    'Status'
];

public function employeeType()
{
    return $this->belongsTo(HRMSEmployeeType::class, 'Employee_Type_No_FK', 'Employee_Type_No_PK');
}

}
