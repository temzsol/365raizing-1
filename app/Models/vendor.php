<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;
    protected $fillable=['fname', 'mname', 'lname', 'vemail', 'vcont', 'vbrand', 'vcomp', 'vservice', 'vgstin', 'vstreet', 'vcity', 'vcode', 'vcountry', 'status', 'is_deleted', 'created_at', 'updated_at'];
}
