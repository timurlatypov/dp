<?php

namespace App\Mail\Review;

use App\Models\Review;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewReviewNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public Review $review;
    public User $author;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function build(): self
    {
        return $this->view('emails.review.created')->subject('Создан новый отзыв');
    }
}
