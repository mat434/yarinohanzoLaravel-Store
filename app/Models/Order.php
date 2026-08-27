<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'email',
        'indirizzo',
        'total_price',
        'stripe_session_id',
        'status',
        'reso_motivo',
        'reso_richiesto_at',
    ];

    protected $casts = [
        'reso_richiesto_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canRequestReturn(): bool
{
    // ->copy() è importante: senza, addDays() modificherebbe l'oggetto Carbon
    // originale in memoria, alterando $order->created_at per il resto della richiesta
    return $this->status === 'in_lavorazione'
        && $this->created_at->copy()->addDays(14)->isFuture();
}
}