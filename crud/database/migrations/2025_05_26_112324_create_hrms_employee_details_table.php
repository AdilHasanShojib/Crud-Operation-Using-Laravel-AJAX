<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('hrms_employee_details', function (Blueprint $table) {
        $table->id('Employee_No_PK');
        $table->string('Employee_UID');
        $table->string('EmployeeName');
        $table->string('FatherName');
        $table->string('MotherName');
        $table->date('DOB');
        $table->tinyInteger('Gender'); // 1=Male, 2=Female
        $table->unsignedBigInteger('Employee_Type_No_FK');
        $table->string('Designation');
        $table->string('Contact_Number');
        $table->string('Email_Address');
        $table->text('Remarks')->nullable();
        $table->tinyInteger('Status'); // 1=Active, 0=Inactive
        $table->timestamps();

        $table->foreign('Employee_Type_No_FK')->references('Employee_Type_No_PK')->on('hrms_employee_types')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrms_employee_details');
    }
};
