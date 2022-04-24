<?php

namespace App\Models;

use App\Exceptions\Feed\InvalidFeedItem;
use App\ProductFeedItem;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use App\Contracts\Feedable;

class Feed implements Responsable
{
    protected string $view;

    protected Collection $feedItems;

    protected Collection $categories;

    public function __construct(
        Collection $categories,
        Collection $items,
        string $view
    ) {
        $this->categories = $categories;
        $this->feedItems = $items->map(fn ($feedable) => $this->castToFeedItem($feedable));
        $this->view = $view;
    }

    public function toResponse($request): Response
    {
        $contents = view($this->view, [
            'items' => $this->feedItems,
            'categories' => $this->categories,
        ]);

        return new Response($contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
        ]);
    }

    /**
     * @param $feedable
     * @return ProductFeedItem
     * @throws InvalidFeedItem
     */
    protected function castToFeedItem($feedable): ProductFeedItem
    {
        if (is_array($feedable)) {
            $feedable = new ProductFeedItem($feedable);
        }

        if ($feedable instanceof ProductFeedItem) {
            $feedable->validate();

            return $feedable;
        }

        if (! $feedable instanceof Feedable) {
            throw InvalidFeedItem::notFeedable($feedable);
        }

        $feedItem = $feedable->toFeedItem();

        if (! $feedItem instanceof ProductFeedItem) {
            throw InvalidFeedItem::notAFeedItem($feedItem);
        }

        $feedItem->validate();

        return $feedItem;
    }
}
