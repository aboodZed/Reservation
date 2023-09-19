<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'avatar',
        'pic1',
        'pic2',
        'pic3',
        'pic4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
