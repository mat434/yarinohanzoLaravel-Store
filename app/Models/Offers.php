<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = [
    'nome', 
    'prezzo', 
    'prezzo_scontato', 
    'acciaio', 
    'larghezzalama', 
    'lunghezzalama', 
    'lunghezzatsuka', 
    'descrizione', 
    'img', 
    'subcategory_id',
    'katana_id',
    'martial_art_id',
    'prezzo_scontato',
    'katana_id',
    'martial_art_id'];

    // Relazione: Questa offerta appartiene a una Katana
    public function katana() {
        return $this->belongsTo(ProductKatanas::class, 'katana_id');
    }

    // Relazione: Questa offerta appartiene a un'Arte Marziale
    public function martialArt() {
        return $this->belongsTo(MartialArts::class, 'martial_art_id');
    }
}
