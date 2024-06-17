<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mytask extends Model
{
    use HasFactory;
    protected $fillable=[ 'brand', 't_title', 'deadline', 't_file', 't_detail', 'assign_date', 'status', 'is_deleted', 'created_at', 'updated_at','comments'];
}
