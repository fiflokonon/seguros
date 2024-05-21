<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Power extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'powers';
    protected $fillable = [
        'min_power',
        'max_power',
        'status'
    ];

    public function fuel_types()
    {
        return $this->belongsToMany(FuelType::class, 'power_fuel_types', 'power_id', 'fuel_type_id');
    }
}
