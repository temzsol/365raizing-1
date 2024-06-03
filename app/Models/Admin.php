<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable=['fname', 'empmob', 'empmail', 'aadhar_no', 'pan_no', 'create_date', 'doj', 'total_leave', 'is_deleted', 'status', 'created_at', 'updated_at'];
}
