<?php

namespace App;

use App\Exceptions\Feed\InvalidFeedItem;
use Carbon\Carbon;
use Exception;

class ProductFeedItem
{
    /**  @var string|null */
    protected ?string $id = null;

    /** @var string */
    protected string $title;

    /** @var int */
    protected int $basePrice;

    /**@var int */
    protected int $discountedPrice;

    /** @var string */
    protected string $picture;

    /** @var string */
    protected string $link;

    /** @var string */
    protected string $vendor;

    /** @var int */
    protected int $vendorCode;

    /** @var int|null */
    protected ?int $categoryId = null;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param array $data
     * @return static
     */
    public static function create(array $data = []): self
    {
        return new static($data);
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param Carbon $updated
     * @return $this
     */
    public function setUpdated(Carbon $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setDiscountedPrice(int $value): self
    {
        $this->discountedPrice = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setBasePrice(int $value): self
    {
        $this->basePrice = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPicture(string $value): self
    {
        $this->picture = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setLink(string $value): self
    {
        $this->link = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVendor(string $value): self
    {
        $this->vendor = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setVendorCode(int $value): self
    {
        $this->vendorCode = $value;

        return $this;
    }

    /**
     * @param int|null $value
     * @return $this
     */
    public function setCategoryId(?int $value): self
    {
        $this->categoryId = $value;

        return $this;
    }

    /**
     * @throws InvalidFeedItem
     */
    public function validate(): void
    {
        $requiredFields = ['id', 'title'];

        foreach ($requiredFields as $requiredField) {
            if (is_null($this->$requiredField)) {
                throw InvalidFeedItem::missingField($this, $requiredField);
            }
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function __get($key)
    {
        if (! isset($this->$key)) {
            throw new Exception("Property `{$key}` doesn't exist");
        }

        return $this->$key;
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->$key);
    }
}
