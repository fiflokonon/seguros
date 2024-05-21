<?php

namespace App\Models;

use Carbon\Doctrine\CarbonType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tarification extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tarifications';
    protected $fillable = [
        'car_category_id',
        'power_id',
        'type_car_id',
        'fuel_type_id',
        'trailer_id',
        'min_place',
        'max_place',
        'price',
        'status'
    ];

    public function car_category()
    {
        return $this->belongsTo(CarCategory::class);
    }

    public function power()
    {
        return $this->belongsTo(Power::class);
    }

    public function fuel_type()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function type_car()
    {
        return $this->belongsTo(TypeCar::class);
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class);
    }

}
