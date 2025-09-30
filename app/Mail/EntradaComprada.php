<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Entrada;

class EntradaComprada extends Mailable
{
    use Queueable, SerializesModels;

    public Entrada $entrada;

    public function __construct(Entrada $entrada)
    {
        $this->entrada = $entrada;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address('noreply@cuentad3.com', 'CUENTAD3'),
            subject: 'Tu entrada para el evento'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.entrada',
            with: [
                'entrada' => $this->entrada,
                'qr' => QrCode::size(200)->generate($this->entrada->codigo),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
