<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
             $table->string('fname')->nullable();
             $table->string('mname')->nullable();
             $table->string('lname')->nullable();
             $table->string('empmail')->nullable();
             $table->string('empmob')->nullable();
             $table->string('empdob')->nullable();
             $table->integer('empbrand')->nullable();
             $table->string('empdiv')->nullable();
             $table->string('empcomp')->nullable();
             $table->string('aadhar_no')->nullable();
             $table->string('aadharcard')->nullable();
             $table->string('aadharcard_s')->nullable();
             $table->string('pan_no')->nullable();
             $table->string('pancard')->nullable();
             $table->string('certificate')->nullable();
             $table->string('certificate_12th')->nullable();
             $table->string('certificate_graduate')->nullable();
             $table->string('certificate_postgraduate')->nullable();
             $table->string('empdoa')->nullable();
             $table->string('online_status')->nullable();
             $table->string('appointment_latter')->nullable();
             $table->string('empdol')->nullable();
             $table->string('empdol_s')->nullable();
             $table->string('empphoto')->nullable();
             $table->string('eloc')->nullable();
             $table->string('designation')->nullable();
             $table->string('office_add')->nullable();
             $table->string('res_id')->nullable();
             $table->string('emergency_name')->nullable();
             $table->string('emergency_no')->nullable();
             $table->string('status')->nullable();
             $table->string('salary')->nullable();
             $table->string('doj')->nullable();
             $table->string('landline')->nullable();
             $table->string('official_id')->nullable();
             $table->string('personal_id')->nullable();
             $table->string('dojl')->nullable();
             $table->string('user_type')->nullable();
             $table->string('emp_id')->nullable();
             $table->string('total_leave')->nullable(); 
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_deleted')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
