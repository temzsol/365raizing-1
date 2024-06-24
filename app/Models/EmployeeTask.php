<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTask extends Model
{
    use HasFactory;
    protected $fillable=['t_title', 'deadline', 't_file', 't_detail', 'assign_date', 'status', 'personal_id', 'emp_id', 'is_deleted', 'created_at', 'updated_at','comments','reporter_id'];
}
