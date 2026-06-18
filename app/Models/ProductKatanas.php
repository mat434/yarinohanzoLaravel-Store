<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductKatanas extends Model
{
    protected $fillable = [
        'nome', 'prezzo', 'acciaio', 'larghezzalama', 
        'lunghezzalama', 'lunghezzatsuka', 'categoria', 
        'descrizione', 'img', 'subcategory_id' // <-- Aggiunta la chiave per la relazione
    ];

    public function subcategory() {
    return $this->belongsTo(Subcategory::class);
}

public function reviews()
{
    // Diciamo a Laravel che questo modello possiede molte recensioni polimorfiche
    return $this->morphMany(\App\Models\Review::class, 'reviewable');
}
}
