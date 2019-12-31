<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarDealership extends Model
{
    protected $table = 'car_dealerships';
    protected $fillable = [
      'name', 'city'
    ];
}
