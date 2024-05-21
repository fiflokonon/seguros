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
        'code',
        'status'
    ];

    public function powers()
    {
        return $this->belongsToMany(Power::class, 'power_fuel_types', 'fuel_type_id', 'power_id');
    }
}
