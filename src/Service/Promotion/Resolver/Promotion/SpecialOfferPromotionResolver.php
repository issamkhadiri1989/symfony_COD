<?php

declare(strict_types=1);

namespace App\Service\Promotion\Resolver\Promotion;

use App\DataTransferObject\Promotion\SpecialOfferPromotion;
use App\DataTransferObject\Reference;
use App\Service\Promotion\Resolver\AbstractPromotionResolver;

class SpecialOfferPromotionResolver extends AbstractPromotionResolver
{
    public function resolve(array $reference): Reference
    {
        if (isset($reference['special_offer']) === true && $reference['special_offer'] === true) {
            return $this->createReference($reference);
        }

        return $this->resolveReference($reference);
    }

    public function createReference(array $input): Reference
    {
        $specialOffer = new SpecialOfferPromotion();

        return $this->buildPromotedReferenceInstance($input, $specialOffer);
    }
}