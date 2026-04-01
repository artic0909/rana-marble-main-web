<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class Orderplacedmai extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $isAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $isAdmin = false)
    {
        $this->order = $order;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->isAdmin ? 'New Order Received: ' . $this->order->order_number : 'Order Confirmed: ' . $this->order->order_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.orderplacedmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('invoice.invoice', ['order' => $this->order]);
        
        return [
            Attachment::fromData(fn () => $pdf->output(), 'Invoice-' . $this->order->order_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
