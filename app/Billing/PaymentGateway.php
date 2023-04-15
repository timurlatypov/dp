<?php

namespace App\Billing;

interface PaymentGateway
{
    public function pay();
}