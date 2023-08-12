<?php

declare(strict_types=1);

namespace App\Service\Promotion\Resolver\Promotion;

use App\DataTransferObject\Promotion\ClearancePromotion;
use App\DataTransferObject\Reference;
use App\Service\Promotion\Resolver\AbstractPromotionResolver;

class ClearancePromotionResolver extends AbstractPromotionResolver
{
    public function resolve(array $reference): Reference
    {
        if (isset($reference['clearance_item']) === true && $reference['clearance_item'] === true) {
            return $this->createReference($reference);
        }

        return $this->resolveReference($reference);
    }

    public function createReference(array $input): Reference
    {
        $flashPromotion = new ClearancePromotion();

        return $this->buildPromotedReferenceInstance($input, $flashPromotion);
    }
}