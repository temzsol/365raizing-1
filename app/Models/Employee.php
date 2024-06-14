<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['fname', 'mname', 'lname', 'empmail', 'empmob', 'empdob', 'empbrand', 'empdiv', 'empcomp', 'aadhar_no', 'aadharcard', 'aadharcard_s', 'pan_no', 'pancard', 'certificate', 'certificate_12th', 'certificate_graduate', 'certificate_postgraduate', 'empdoa', 'online_status', 'appointment_latter', 'empdol', 'empdol_s', 'empphoto', 'eloc', 'designation', 'office_add', 'res_id', 'emergency_name', 'emergency_no', 'status', 'salary', 'doj', 'landline', 'official_id', 'personal_id', 'dojl', 'user_type', 'emp_id', 'total_leave', 'created_at', 'updated_at', 'is_deleted','role'];
}
