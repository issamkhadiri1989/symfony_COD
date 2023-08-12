<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer\Reference;

use App\DataTransferObject\Promotion\ClearancePromotion;
use App\DataTransferObject\Reference;

final class FlashPromotionRenderer extends AbstractPromotionSupport
{
    protected static int $priority = 100;

    public function supports(Reference $reference): bool
    {
        return parent::supports($reference) && $reference->getPromotion() instanceof ClearancePromotion;
    }

    protected function getContext(Reference $reference): array
    {
        return \array_merge(parent::getContext($reference), ['extra_classes' => 'flash_promotion']);
    }
}