<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function article()
    {
        $katana = [
            'name' => 'Yari no Hanzo',
            'description' => 'Una katana leggendaria forgiata da un maestro artigiano',
            'price' => 1500,
            'image' => '/immagini/0YAGYUKATANA.jpg',
        ];
        return view('article', compact('katana'));
    }

    public function offers()
    {
        return view('offers');
    }

    public function login()
    {
        return view('login');
    }
}
