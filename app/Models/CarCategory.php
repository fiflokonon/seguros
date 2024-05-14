<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'car_categories';
    protected $fillable = [
        'title',
        'description',
        'fuel_type_id',
        'status'
    ];

    public function fuel_type()
    {
        return $this->belongsTo(FuelType::class);
    }
}
