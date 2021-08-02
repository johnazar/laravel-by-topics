<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGatway;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store()
    {
        $paymentGateway = new PaymentGatway('USD');
        dd($paymentGateway->charge(2500));

    }
}
