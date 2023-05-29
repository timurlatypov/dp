<?php

namespace App\Billing;

use App\Models\Order;

interface PaymentGateway
{
    public function registerOrder(Order $order);
}