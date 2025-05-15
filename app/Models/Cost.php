<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'details',
        'cost',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
