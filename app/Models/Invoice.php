<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'fuel_type_id',
        'power_id',
        'type_car_id',
        'car_category_id',
        'number_place',
        'brand_id',
        'trailer_id',
        'regis_number',
        'model',
        'first_name',
        'last_name',
        'email',
        'total'
    ];

    public function parameters()
    {
        return $this->belongsToMany(Parameter::class, 'invoice_parameters', 'invoice_id', 'parameter_id');
    }
}
