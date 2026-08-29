<?php

namespace App\Models;
use App\Models\ReturnItem;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'nome',
        'prezzo',
        'quantity',
        'img',
        'type',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class);
    }
}