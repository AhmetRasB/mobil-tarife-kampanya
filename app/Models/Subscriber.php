<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad',
        'soyad',
        'tc_no',
        'telefon',
        'eposta',
        'adres',
        'kayit_tarihi',
        'aktif_mi'
    ];

    protected $casts = [
        'kayit_tarihi' => 'datetime',
        'aktif_mi' => 'boolean'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'abone_id');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'abone_id');
    }

    public function simCards()
    {
        return $this->hasMany(SimCard::class, 'abone_id');
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'abone_id');
    }
} 