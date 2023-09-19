<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'end',
        'cost',
    ];

    protected $casts = [
        'deleted_at' => 'date',
        'end' => 'date',
        'cost' => 'double',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(SubscriptionType::class, 'type_id');
    }
}
