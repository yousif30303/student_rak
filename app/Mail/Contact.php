<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;
    
    public $reg_id;
    public $name;
    public $mobile;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $message)
    {
        $this->reg_id = auth()->user()->reg_id;        
        $this->name = auth()->user()->name;
        $this->mobile = auth()->user()->mobile;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('yousif10@hotmail.com','yousif'),
            subject: 'Mobile App Enquiry',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.contact',
            with: [
                'reg_id' => $this->reg_id,
                'name' => $this->name,
                'mobile' => $this->mobile,
                'message' => $this->message,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
