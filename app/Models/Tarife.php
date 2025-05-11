<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarife extends Model
{
    use HasFactory;

    protected $table = 'tarifeler';

    protected $fillable = [
        'ad',
        'fiyat',
        'internet_miktari',
        'dakika_miktari',
        'sms_miktari',
        'aktif'
    ];

    public function abonelikler()
    {
        return $this->hasMany(Abonelik::class);
    }

    public function kampanyalar()
    {
        return $this->belongsToMany(Kampanya::class, 'kampanya_tarife');
    }
}
