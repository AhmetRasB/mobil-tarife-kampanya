<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teklif extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tarife_id',
        'kampanya_id',
        'ad_soyad',
        'telefon',
        'email',
        'adres',
        'notlar',
        'durum'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarife()
    {
        return $this->belongsTo(Tarife::class);
    }

    public function kampanya()
    {
        return $this->belongsTo(Kampanya::class);
    }
}
