<?php

declare(strict_types=1);

namespace App\DataTransferObject\Promotion;

/**
 * This is a standard promotion
 */
class Promotion extends AbstractPromotion
{
    public function __construct()
    {
        $this->promotion = 'standard';
    }
}