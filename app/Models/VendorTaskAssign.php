<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTaskAssign extends Model
{
    use HasFactory;
    protected $fillable=['brand', 'service', 'assign_date', 'deadline_date', 'task_detail', 'task_file', 'status', 'is_deleted', 'created_at', 'updated_at','vendor_id'];
}
