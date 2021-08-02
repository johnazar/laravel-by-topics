<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGatway;
use App\Order\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(PaymentGatway $paymentGateway, OrderDetails $orderDetails)
    {
        $order = $orderDetails->all();
        dd($paymentGateway->charge(2500));

    }
}
