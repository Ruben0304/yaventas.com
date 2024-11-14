<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoCompra extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.correo',  // Esta será tu vista en resources/views/emails/compra.blade.php
        );
    }


    use SerializesModels;

    public function __construct(
        public $userData,
        public $orderData,
        public $products
    ) {}

    public function envelope()
    {
        return new Envelope(
            subject: 'Nueva Compra en YaVentas.com',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            // Si necesitas adjuntar archivos:
            // Attachment::fromPath('/path/to/file')
            //    ->as('nombre.pdf')
            //    ->withMime('application/pdf'),
        ];
    }
}
