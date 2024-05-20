<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerFuelType extends Model
{
    use HasFactory;
    protected $table = 'power_fuel_types';
    protected $fillable = [
        'power_id',
        'fuel_type_id'
    ];
}
