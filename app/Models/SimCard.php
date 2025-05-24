<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'numara',
        'puk',
        'pin',
        'aktivasyon_tarihi',
        'durum',
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'abone_id');
    }

    // Example relationship (uncomment and adjust if you have a Subscriber model)
    // public function subscriber()
    // {
    //     return $this->belongsTo(Subscriber::class);
    // }
} 