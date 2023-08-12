<?php

declare(strict_types=1);

namespace App\Service\Promotion\Resolver\Promotion;

use App\DataTransferObject\Promotion\ConditionedPromotion;
use App\DataTransferObject\Reference;
use App\Service\Promotion\Resolver\AbstractPromotionResolver;

final class SpecialDiscountResolver extends AbstractPromotionResolver
{
    public function resolve(array $reference): Reference
    {
        if ($reference['promotion']['special_discount'] === true) {
            return $this->createReference($reference);
        }

        return $this->resolveReference($reference);
    }

    public function createReference(array $input): Reference
    {
        $pricePromotion = new ConditionedPromotion();

        if (isset($input['promotion']['conditions'])) {
            $conditions = $input['promotion']['conditions'];
            foreach ($conditions as $condition) {
                $pricePromotion->addCondition($condition['condition']);
            }
        }

        return $this->buildPromotedReferenceInstance($input, $pricePromotion);
    }
}