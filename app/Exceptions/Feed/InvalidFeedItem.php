<?php

namespace App\Exceptions\Feed;

use App\ProductFeedItem;
use Exception;

class InvalidFeedItem extends Exception
{
    /** @var ProductFeedItem|null */
    public ?ProductFeedItem $subject;

    public static function notFeedable($subject)
    {
        return (new static('Object doesn\'t implement `Spatie\Feed\Feedable`'))->withSubject($subject);
    }

    public static function notAFeedItem($subject)
    {
        return (new static('`toFeedItem` should return an instance of `Spatie\Feed\Feedable`'))->withSubject($subject);
    }

    public static function missingField(ProductFeedItem $subject, $field): InvalidFeedItem
    {
        return (new static("Field `{$field}` is required"))->withSubject($subject);
    }

    protected function withSubject($subject): InvalidFeedItem
    {
        $this->subject = $subject;

        return $this;
    }
}