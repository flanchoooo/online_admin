<?php

namespace App\Mail;

use App\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $pdf;
    public $enquiry;
    public $quotation;

    /**
     * Create a new message instance.
     * @param Customer $customer
     * @param $pdf
     * @param $enquiry
     * @param $quotation
     * @internal param Customer $Customer
     */
    public function __construct(Customer $customer, $pdf, $enquiry, $quotation){
        $this->customer = $customer;
        $this->pdf = $pdf;
        $this->enquiry = $enquiry;
        $this->quotation = $quotation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('mail.invoice.send')
            ->subject('[Ordering] Invoice for Enquiry #' . $this->enquiry)
            ->attachData($this->pdf, 'invoice.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
