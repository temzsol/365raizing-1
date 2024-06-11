<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTask extends Model
{
    use HasFactory;
    protected $fillable=['emp_id', 'brand', 't_title', 'deadline', 't_file', 't_detail', 'assign_date', 'status', 'admin_email', 'is_deleted', 'created_at', 'updated_at'];
}
