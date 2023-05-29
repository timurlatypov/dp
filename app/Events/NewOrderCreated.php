<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewOrderCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	public Order $order;
	public $customer;
	public $managers;
	public $admins;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $customer, $managers, $admins)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->managers = $managers;
        $this->admins = $admins;
    }
}
