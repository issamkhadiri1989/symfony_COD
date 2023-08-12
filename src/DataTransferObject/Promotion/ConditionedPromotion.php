<?php

declare(strict_types=1);

namespace App\DataTransferObject\Promotion;

class ConditionedPromotion extends AbstractPromotion
{
    private ?array $conditions = null;

    public function __construct()
    {
        $this->promotion = 'conditioned offer';
    }

    public function addCondition(string $condition): AbstractPromotion
    {
        $this->conditions[] = $condition;

        return $this;
    }

    public function getConditions(): ?array
    {
        return $this->conditions;
    }
}
