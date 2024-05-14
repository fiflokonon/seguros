<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeCar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'type_cars';
    protected $fillable = [
        'title',
        'description',
        'max_power',
        'min_power',
        'fuel_type_id',
        'status'
    ];
}
