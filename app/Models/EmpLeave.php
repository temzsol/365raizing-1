<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpLeave extends Model
{
    use HasFactory;
    protected $fillable=['id', 'emp_id', 'l_title', 'l_date', 'l_desc', 'l_status', 'to_date', 'no_days', 'type', 'leave_remaining', 'attachment', 'is_deleted', 'created_at', 'updated_at', 'admin_hr_comments', 'approved_by', 'approve_status_of_admin'];
}
