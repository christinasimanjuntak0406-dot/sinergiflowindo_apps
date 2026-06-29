<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderNotification extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Pesanan Baru')
                    ->view('emails.order');
    }
}