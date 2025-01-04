<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $state;
    public $country;
    public $zip;
    public $day_time_phone;
    public $evening_phone;
    public $cellular_phone;
    public $email;
    public $time_to_connect;
    public $message_content;
    public $role;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->country = $data['country'];
        $this->zip = $data['zip'];
        $this->day_time_phone = $data['day_time_phone'];
        $this->evening_phone = $data['evening_phone'];
        $this->cellular_phone = $data['cellular_phone'];
        $this->email = $data['email'];
        $this->time_to_connect = $data['time_to_connect'];
        $this->message_content = $data['message_content'];
        $this->role = $data['role'] ?? 0;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact_form_submission') // You will need to create this view
                    ->subject('EBB inquiry')
                    ->with([
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'address' => $this->address,
                        'city' => $this->city,
                        'state' => $this->state,
                        'country' => $this->country,
                        'zip' => $this->zip,
                        'day_time_phone' => $this->day_time_phone,
                        'evening_phone' => $this->evening_phone,
                        'cellular_phone' => $this->cellular_phone,
                        'email' => $this->email,
                        'time_to_connect' => $this->time_to_connect,
                        'message_content' => $this->message_content,
                        'role' => $this->role,
                    ]);
    }
}
