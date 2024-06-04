<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $table = 'holidays';
    protected $fillable= ['date', 'day', 'holidays', 'company_id', 'status', 'is_deleted', 'created_at', 'updated_at'];
}
