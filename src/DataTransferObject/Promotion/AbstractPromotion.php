<?php

declare(strict_types=1);

namespace App\DataTransferObject\Promotion;

abstract class AbstractPromotion implements PromotionInterface
{
    protected ?string $promotion;

    protected ?float $amount = 0.0;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): AbstractPromotion
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }
}