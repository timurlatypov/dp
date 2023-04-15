<?php

namespace App\Exceptions\Feed;

use App\Models\ProductFeedItem;
use Exception;

class InvalidFeedItem extends Exception
{


    public static function notFeedable($subject): self
    {
        return (new static('Object doesn\'t implement `Spatie\Feed\Feedable`'))->withSubject($subject);
    }

    public static function notAFeedItem($subject): self
    {
        return (new static('`toFeedItem` should return an instance of `Spatie\Feed\Feedable`'))->withSubject($subject);
    }

    /**
     * @psalm-param 'id'|'title' $field
     */
    public static function missingField(ProductFeedItem $subject, string $field): InvalidFeedItem
    {
        return (new static("Field `{$field}` is required"))->withSubject($subject);
    }

    /**
     * @return static
     */
    protected function withSubject(ProductFeedItem $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}