<?php

namespace App\Billing;
use Illuminate\Support\Str;

class PaymentGatway
{
    private $currency;
    public function __construct($currency)
    {
        $this->currency=$currency;
    }
    public function charge($amount)
    {
        // charge the bank

        return[
            'amount'=>$amount,
            'currency'=>$this->currency,
            'confirmation_number'=>Str::random(),
        ];
    }
}