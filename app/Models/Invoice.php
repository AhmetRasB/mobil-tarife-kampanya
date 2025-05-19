<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_SUSPENDED = 'suspended';

    protected $fillable = [
        'subscriber_id',
        'abonelik_id',
        'amount',
        'invoice_date',
        'due_date',
        'status',
        'billing_period',
        'description'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function abonelik()
    {
        return $this->belongsTo(Abonelik::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            self::STATUS_PAID => 'success',
            self::STATUS_UNPAID => 'warning',
            self::STATUS_SUSPENDED => 'danger',
        ][$this->status] ?? 'secondary';
    }

    public function getStatusLabelAttribute()
    {
        return [
            self::STATUS_PAID => 'Ödendi',
            self::STATUS_UNPAID => 'Beklemede',
            self::STATUS_SUSPENDED => 'Askıya Alındı',
        ][$this->status] ?? $this->status;
    }
} 