<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'sim_kart_id',
        'alici',
        'mesaj',
        'tarih',
        'durum'
    ];

    protected $casts = [
        'tarih' => 'datetime'
    ];

    public function simCard()
    {
        return $this->belongsTo(SimCard::class, 'sim_kart_id');
    }
} 