<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer\Reference;

use App\DataTransferObject\PromotedReference;
use App\DataTransferObject\Promotion\ConditionedPromotion;
use App\DataTransferObject\Reference;
use function array_merge;

final class ConditionedPromotionRenderer extends AbstractPromotionSupport
{
    protected static int $priority = 300;

    public function supports(Reference $reference): bool
    {
        return parent::supports($reference) && $reference->getPromotion() instanceof ConditionedPromotion;
    }

    public function getTemplatePath(): string
    {
        return 'price/web_price.html.twig';
    }

    /**
     * @param PromotedReference $reference
     *
     * @return array
     */
    protected function getContext(Reference $reference): array
    {
        return array_merge(parent::getContext($reference), [
            'extra_classes' => 'conditioned_promotion',
            'conditions' => $reference->getPromotion()->getConditions(),
        ]);
    }
}