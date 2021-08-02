<?php

namespace App\Billing;
use Illuminate\Support\Str;

class PaymentGatway
{
    private $currency;
    private $discount;
    public function __construct($currency)
    {
        $this->currency=$currency;
        $this->discount=0;
    }
    public function charge($amount)
    {
        // charge the bank

        return[
            'amount'=>$amount - $this->discount,
            'currency'=>$this->currency,
            'discount'=>$this->discount,
            'confirmation_number'=>Str::random(),
        ];
    }
    public function setDiscount($discount)
    {
        // charge the bank
        $this->discount=$discount;
    }
}