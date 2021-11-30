<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stall_id',
        'rate',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function stalls()
    {
        return $this->belongsTo(Stall::class);
    }
}
