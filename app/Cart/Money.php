<?php

namespace App\Cart;

use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as BaseMoney;
use NumberFormatter;

class Money
{
    protected $money;

    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('RUB'));
    }

    public function amount(): string
    {
        return $this->money->getAmount();
    }

    public function formatted(): string
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('ru_RU', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );

        return $formatter->format($this->money);
    }

    /**
     * @return static
     */
    public function add(Money $money): self
    {
        $this->money = $this->money->add($money->instance());

        return $this;
    }

    public function instance(): BaseMoney
    {
        return $this->money;
    }
}
