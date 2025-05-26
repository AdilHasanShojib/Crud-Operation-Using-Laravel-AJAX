<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRMSEmployeeType;
use App\Models\HRMSEmployeeDetail;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;


class EmployeeController extends Controller
{
    
 function index(){

 
    $types = HRMSEmployeeType::where('Status', 1)->get();
    return view('employees', compact('types'));
}





function store(Request $request){
    
    $validator = Validator::make($request->all(), [
        'Employee_UID' => 'required|unique:hrms_employee_details,Employee_UID',
        'EmployeeName' => 'required|string|max:100',
        'FatherName' => 'required|string|max:100',
        'MotherName' => 'required|string|max:100',
        'DOB' => 'required|date',
        'Gender' => 'required|in:1,2',
        'Employee_Type_No_FK' => 'required|exists:hrms_employee_types,Employee_Type_No_PK',
        'Designation' => 'required|string|max:100',
        'Contact_Number' => 'required|string|max:20',
        'Email_Address' => 'required|email|unique:hrms_employee_details,Email_Address',
        'Status' => 'required|in:0,1',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

  
    HRMSEmployeeDetail::create([
        'Employee_UID' => $request->Employee_UID,
        'EmployeeName' => $request->EmployeeName,
        'FatherName' => $request->FatherName,
        'MotherName' => $request->MotherName,
        'DOB' => $request->DOB,
        'Gender' => $request->Gender,
        'Employee_Type_No_FK' => $request->Employee_Type_No_FK,
        'Designation' => $request->Designation,
        'Contact_Number' => $request->Contact_Number,
        'Email_Address' => $request->Email_Address,
        'Remarks' => $request->Remarks,
        'Status' => $request->Status
    ]);

    return response()->json(['message' => 'Employee saved successfully!']);
}



public function getEmployees()
{
    $employees = HRMSEmployeeDetail::with('employeeType')->get();

    $data = [];

    foreach ($employees as $emp) {
        $age = Carbon::parse($emp->DOB)->age; // calculate age

        $data[] = [
            'Employee_UID' => $emp->Employee_UID,
            'Name' => $emp->EmployeeName,
            'Designation' => $emp->Designation,
            'Employee_Type' => $emp->employeeType->Type_Name ?? 'N/A',
            'Contact' => $emp->Contact_Number,
            'Email' => $emp->Email_Address,
            'DOB' => $emp->DOB,
            'Age' => $age,
            'Status' => $emp->Status ? 'Active' : 'Inactive',
        ];
    }

    return response()->json(['data' => $data]);
}


 function edit($id){
    $employee = HRMSEmployeeDetail::findOrFail($id);
    return response()->json($employee);
}


public function update(Request $request, $id)
{
    $employee = HRMSEmployeeDetail::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'EmployeeName' => 'required|string|max:100',
        'FatherName' => 'required|string|max:100',
        'MotherName' => 'required|string|max:100',
        'DOB' => 'required|date',
        'Gender' => 'required|in:1,2',
        'Employee_Type_No_FK' => 'required|exists:hrms_employee_types,Employee_Type_No_PK',
        'Designation' => 'required|string|max:100',
        'Contact_Number' => 'required|string|max:20',
        'Email_Address' => 'required|email|unique:hrms_employee_details,Email_Address,'.$id.',Employee_No_PK',
        'Status' => 'required|in:0,1',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $employee->update($request->all());

    return response()->json(['message' => 'Employee updated successfully!']);
}




function destroy($id){
    HRMSEmployeeDetail::findOrFail($id)->delete();
    return response()->json(['message' => 'Employee deleted successfully!']);
}















}