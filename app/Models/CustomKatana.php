<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomKatana extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'nagasa_lenght',
        'tsuka_lenght',
        'sori',
        'motohaba',
        'kitae',
        'bohi',
        'tsuba',
        'fuchikashira',
        'menuki',
        'habaki',
        'seppa',
        'samegawa',
        'stile_tsuka',
        'colore_tsuka',
        'tipo_saya',
        'colore_sageo'
    ];
}
