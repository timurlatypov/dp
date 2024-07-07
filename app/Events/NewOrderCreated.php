<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Order $order;
    public $customer;
    public $managers;
    public $admins;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order, $customer, $managers, $admins)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->managers = $managers;
        $this->admins = $admins;
    }
}
