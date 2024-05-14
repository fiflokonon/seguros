<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'fuel_types';
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    public function car_cateogories()
    {
        return $this->hasMany(CarCategory::class);
    }
}
