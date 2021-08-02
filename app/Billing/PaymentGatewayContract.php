<?php

namespace App\Billing;

// Interface
Interface PaymentGatewayContract
{

    public function charge($amount);

    public function setDiscount($discount);

}