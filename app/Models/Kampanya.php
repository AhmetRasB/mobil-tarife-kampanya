<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kampanya extends Model
{
    use HasFactory;

    protected $table = 'kampanyalar';

    protected $fillable = [
        'ad',
        'aciklama',
        'baslangic_tarihi',
        'bitis_tarihi',
        'indirim_orani',
        'aktif'
    ];

    protected $casts = [
        'baslangic_tarihi' => 'datetime',
        'bitis_tarihi' => 'datetime'
    ];

    public function tarifeler()
    {
        return $this->belongsToMany(Tarife::class, 'kampanya_tarife');
    }

    public function abonelikler()
    {
        return $this->hasMany(Abonelik::class, 'kampanya_id');
    }
}
