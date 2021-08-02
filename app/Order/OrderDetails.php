<?php
namespace App\Order;

use App\Billing\PaymentGatway;

class OrderDetails
{
    private $paymentGatway;
    public function __construct(PaymentGatway $paymentGatway)
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