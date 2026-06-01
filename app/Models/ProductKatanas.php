<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductKatanas extends Model
{
    protected $fillable = [
        'nome', 'prezzo', 'acciaio', 'larghezzalama', 
        'lunghezzalama', 'lunghezzatsuka', 'categoria', 
        'descrizione', 'img'
    ];

    public function subcategory() {
    return $this->belongsTo(Subcategory::class);
}
}
