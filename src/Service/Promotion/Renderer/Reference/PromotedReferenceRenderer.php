<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer\Reference;

use App\DataTransferObject\Promotion\Promotion;
use App\DataTransferObject\Promotion\GlobalDiscountPromotion;
use App\DataTransferObject\Reference;

final class PromotedReferenceRenderer extends AbstractPromotionSupport
{
    protected static int $priority = 200;

    public function supports(Reference $reference): bool
    {
        return parent::supports($reference) && (
            $reference->getPromotion() instanceof Promotion ||
            $reference->getPromotion() instanceof GlobalDiscountPromotion
        );
    }

    protected function getContext(Reference $reference): array
    {
        return \array_merge(parent::getContext($reference), ['extra_classes' => 'standard_promo']);
    }
}