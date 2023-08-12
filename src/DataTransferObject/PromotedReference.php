<?php

declare(strict_types=1);

namespace App\DataTransferObject;

use App\DataTransferObject\Promotion\PromotionInterface;

class PromotedReference extends Reference
{
    private ?PromotionInterface $promotion;

    public function isPromotional(): bool
    {
        return true;
    }

    public function getPromotion(): ?PromotionInterface
    {
        return $this->promotion;
    }

    public function setPromotion(?PromotionInterface $promotion): PromotedReference
    {
        $this->promotion = $promotion;

        return $this;
    }
}