<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonelik extends Model
{
    use HasFactory;

    protected $table = 'abonelikler';

    protected $fillable = [
        'user_id',
        'musteri_adi',
        'telefon',
        'email',
        'tarife_id',
        'kampanya_id',
        'baslangic_tarihi',
        'bitis_tarihi',
        'aktif'
    ];

    protected $casts = [
        'baslangic_tarihi' => 'datetime',
        'bitis_tarihi' => 'datetime'
    ];

    public function tarife()
    {
        return $this->belongsTo(Tarife::class);
    }

    public function kampanya()
    {
        return $this->belongsTo(Kampanya::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function faturalar()
    {
        return $this->hasMany(Invoice::class, 'abonelik_id');
    }
}
