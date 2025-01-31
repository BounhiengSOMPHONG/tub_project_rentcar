<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_cars extends Model
{
    use HasFactory;
    
    protected $fillable = ["car_name","description","price_daily", "quantity", "image", "car_type_id","car_status"];
}
