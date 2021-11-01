<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $receipt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $receipt = $this->receipt;
        return $this->from('no-reply@gmail.com')
        ->subject('Invoice #'.$receipt['invoice_no'].' for order #'.$receipt['order_number'].' due '.$receipt['arrival_date'])
        ->view('mail.receipt.order_receipt', compact('receipt'));
    }
}
