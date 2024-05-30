<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'complaints';
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'manager_id',
        'images',
        'state',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        $this->belongsTo(User::class, 'manager_id');
    }

    public function answers()
    {
        return $this->hasMany(ComplaintAnswer::class);
    }
}
