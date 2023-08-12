<?php

declare(strict_types=1);

namespace App\Service\Promotion\Resolver\Promotion;

use App\DataTransferObject\Promotion\Promotion;
use App\DataTransferObject\Reference;
use App\Service\Promotion\Resolver\AbstractPromotionResolver;

/**
 * Resolves a reference that has regular promotion.
 */
final class PromotionResolver extends AbstractPromotionResolver
{
    public function resolve(array $reference): Reference
    {
        if ($reference['promotion']['standard'] === true) {
            return $this->createReference($reference);
        }

        return $this->resolveReference($reference);
    }

    public function createReference(array $input): Reference
    {
        $promotion = new Promotion();

        return $this->buildPromotedReferenceInstance($input, $promotion);
    }
}
