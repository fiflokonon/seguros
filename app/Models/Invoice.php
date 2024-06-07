<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

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
        'place_number',
        'brand_id',
        'trailer_id',
        'regis_number',
        'model',
        'first_name',
        'last_name',
        'email',
        'phone',
        'total',
        'status',
        'state',
        'initial_price',
        'attestation_price',
        'accessories_price',
        'code',
        'sub_total',
        'vat',
        'link',
        'extra_price'
    ];

    public function accessories()
    {
        return $this->belongsToMany(Parameter::class, 'invoice_parameters', 'invoice_id', 'parameter_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class);
    }

    public function power()
    {
        return $this->belongsTo(Power::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
