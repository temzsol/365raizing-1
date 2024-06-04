<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_query extends Model
{
    use HasFactory;
    protected $fillable=['created_by', 'leadtype', 'ct_name', 'ct_mail', 'ct_mob', 'ct_phone', 'reference_through', 'profession', 'nationality', 'address', 'query_brand', 'query_division', 'query_emp', 'ct_passport', 'query_details', 'query_date', 'status', 'created_at', 'updated_at', 'is_deleted'];
}
