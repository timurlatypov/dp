<?php

namespace App\Events;

use App\Models\Review;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewReviewCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Review $review;
    public array $managers;
    public array $admins;

    /**
     * Create a new event instance.
     */
    public function __construct(Review $review, array $managers, array $admins)
    {
        $this->review = $review;
        $this->managers = $managers;
        $this->admins = $admins;
    }
}
