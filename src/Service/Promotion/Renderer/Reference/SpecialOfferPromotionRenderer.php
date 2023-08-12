<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer\Reference;

use App\DataTransferObject\Promotion\SpecialOfferPromotion;
use App\DataTransferObject\Reference;

class SpecialOfferPromotionRenderer extends AbstractPromotionSupport
{
    protected static int $priority = 50;

    public function supports(Reference $reference): bool
    {
        return parent::supports($reference) && $reference->getPromotion() instanceof SpecialOfferPromotion;
    }

    protected function getContext(Reference $reference): array
    {
        return \array_merge(parent::getContext($reference), [
            'extra_classes' => 'special_offer',
        ]);
    }
}