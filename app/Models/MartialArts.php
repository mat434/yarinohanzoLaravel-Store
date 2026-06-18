<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MartialArts extends Model
{
    protected $fillable = ['nome', 'prezzo', 'materiale', 'descrizione', 'img'];

    public function subcategory() {
    return $this->belongsTo(Subcategory::class);
}

public function reviews()
{
    return $this->morphMany(\App\Models\Review::class, 'reviewable');
}
}
