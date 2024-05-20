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
        'code_category',
        'description',
        'status'
    ];

}
