<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order_full;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_full)
    {
        $this->order_full = $order_full;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order_full->email,  $this->order_full->customer_name)
            ->bcc('artyom1996a@gmail.com')
            ->subject('Order Evrika.am')
            ->view('emails.paymentmail');
    }
}
