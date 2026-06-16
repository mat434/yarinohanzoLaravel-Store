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

public function reviews(): HasMany
    {
        // Specifichiamo 'product_id' come chiave esterna presente nella tabella reviews
        return $this->hasMany(Review::class, 'product_id');
    }
}
