<?php

declare(strict_types=1);

namespace App\DataTransferObject\Promotion;

/**
 * Item in clearance promotion type
 */
class ClearancePromotion extends AbstractPromotion
{
    public function __construct()
    {
        $this->promotion = 'item in clearance';
    }
}