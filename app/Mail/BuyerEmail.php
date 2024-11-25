<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $content;
    public function __construct($data)
    {
        $this->subject = $data['subject'];
        $this->content = $data['email_content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.buyer-email')  // Specify the view
                    ->subject($this->subject)      // Use the dynamic subject
                    ->with([
                        'content' => $this->content // Pass the email content to the view
                    ]);
    }
}
