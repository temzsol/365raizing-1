<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTask extends Model
{
    use HasFactory;
    protected $fillable=['t_title', 'deadline', 't_file', 't_detail', 'assign_date', 'status', 'personal_id', 'task_assign_from', 'is_deleted', 'created_at', 'updated_at', 'comments', 'task_assign_to', 'user_type','task_from'];
}
