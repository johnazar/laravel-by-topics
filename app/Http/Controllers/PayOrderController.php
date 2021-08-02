<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGatway;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(PaymentGatway $paymentGateway)
    {

        dd($paymentGateway->charge(2500));

    }
}
