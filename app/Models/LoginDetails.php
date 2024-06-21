<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginDetails extends Model
{
    use HasFactory;
    protected $table = 'login_details';
    protected $fillable = ['id', 'uemail', 'ip', 'login_time', 'logout_time', 'login_date', 'current_status', 'created_at', 'updated_at'];
}
