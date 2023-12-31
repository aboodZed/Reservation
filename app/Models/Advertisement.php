<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'pic',
    ];

    protected $casts = [
        'deleted_at' => 'date',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
