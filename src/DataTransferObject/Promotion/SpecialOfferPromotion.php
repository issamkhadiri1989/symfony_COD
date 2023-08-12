<?php

declare(strict_types=1);

namespace App\DataTransferObject\Promotion;

/**
 * some special offer promotion
 */
class SpecialOfferPromotion extends AbstractPromotion
{
    public function __construct()
    {
        $this->promotion = 'special offer';
    }
}