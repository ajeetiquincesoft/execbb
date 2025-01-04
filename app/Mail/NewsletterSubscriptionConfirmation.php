<?php

namespace App\Mail;
use App\Models\NewsLetterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(NewsLetterSubscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.news_letter_subscription_confirmation')
                    ->subject('Newsletter Subscription Confirmation');
    }
}
