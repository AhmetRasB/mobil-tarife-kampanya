<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'marka',
        'model',
        'imei',
        'seri_no',
        'satis_tarihi',
        'fiyat',
        'durum'
    ];

    protected $casts = [
        'satis_tarihi' => 'datetime',
        'fiyat' => 'decimal:2'
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'abone_id');
    }

    public function callLogs()
    {
        return $this->hasMany(CallLog::class, 'telefon_id');
    }
} 