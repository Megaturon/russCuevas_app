<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $quoteData; // Add this

    /**
     * Create a new message instance.
     */
    public function __construct($data) // Accept data here
    {
        $this->quoteData = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Quote Request from ' . $this->quoteData['name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quote', // Change this!
        );
    }
}