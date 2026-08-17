<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $indirizzo;
    public $totalPrice;
    public $customKatana;
    public $cart;

    public function __construct($nome, $indirizzo, $totalPrice, $customKatana, $cart)
    {
        $this->nome = $nome;
        $this->indirizzo = $indirizzo;
        $this->totalPrice = $totalPrice;
        $this->customKatana = $customKatana;
        $this->cart = $cart;
    }

    public function build()
    {
        return $this->subject('Conferma Ordine - YariNoHanzo')
            ->view('mail.order-confirmation');
    }
}