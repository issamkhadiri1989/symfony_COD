<?php

declare(strict_types=1);

namespace App\DataTransferObject\Promotion;

class GlobalDiscountPromotion extends AbstractPromotion
{
    public function __construct()
    {
        $this->promotion = 'Global Discount';
    }
}