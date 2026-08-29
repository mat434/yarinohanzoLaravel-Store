<?php

namespace App\Mail;

use App\Models\ReturnRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnRequestConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $returnRequest;
    public $labelUrl;

    public function __construct(ReturnRequest $returnRequest, string $labelUrl)
{
    $this->returnRequest = $returnRequest;
    $this->labelUrl = $labelUrl;
}

    public function build()
    {
        return $this->subject('Richiesta di Reso Confermata - YariNoHanzo')
            ->view('mail.return-confirmation');
    }
}