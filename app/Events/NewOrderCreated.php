<?php

namespace App\Events;

use App\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrderCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	public $order;
	public $customer;
	public $managers;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $customer, $managers)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->managers = $managers;
    }

}
