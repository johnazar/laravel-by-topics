<?php
namespace App\Order;

use App\Billing\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGatway;
    public function __construct(PaymentGatewayContract $paymentGatway)
    {
        $this->paymentGatway = $paymentGatway;
    }
    public function all()
    {
        $this->paymentGatway->setDiscount(50);
        return[
            'name'=> 'John',
            'addres'=>'Building 123'
        ];

    }
}