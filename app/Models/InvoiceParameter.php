<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceParameter extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'invoice_parameters';
    protected $fillable = [
        'invoice_id',
        'parameter_id'
    ];
}
