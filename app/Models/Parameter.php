<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'parameters';
    protected $fillable = [
        'title',
        'description',
        'value',
        'accessory',
        'status'
    ];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_parameters', 'parameter_id', 'invoice_id');
    }
}
