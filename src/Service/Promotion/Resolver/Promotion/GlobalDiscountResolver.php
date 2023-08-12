<?php

declare(strict_types=1);

namespace App\Service\Promotion\Resolver\Promotion;

use App\DataTransferObject\Promotion\GlobalDiscountPromotion;
use App\DataTransferObject\Reference;
use App\Service\Promotion\Resolver\AbstractPromotionResolver;

final class GlobalDiscountResolver extends AbstractPromotionResolver
{
    public function resolve(array $reference): Reference
    {
        if ($reference['promotion']['global_discount'] === true) {
            return $this->createReference($reference);
        }

        return $this->resolveReference($reference);
    }

    public function createReference(array $input): Reference
    {
        $webPromotion = new GlobalDiscountPromotion();

        $inputPromotion = $input['promotion'];
        $amount = $inputPromotion['amount'] ? ($inputPromotion['amount']['rate'] ?? 0) : 0;

        $promotion = $webPromotion->setAmount($amount);

        return $this->buildPromotedReferenceInstance($input, $promotion);
    }
}