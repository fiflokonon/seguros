<?php

namespace App\Models;

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
        'car_type_id',
        'trailer_id',
        'min_place',
        'max_place',
        'price'
    ];

}
