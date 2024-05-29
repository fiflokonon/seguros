<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintAnswer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'complaint_answers';
    protected $fillable = [
        'complaint_id',
        'user_id',
        'body',
        'status'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
