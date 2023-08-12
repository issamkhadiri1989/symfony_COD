<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer\Reference;

use App\DataTransferObject\PromotedReference;
use App\DataTransferObject\Reference;
use App\Service\Promotion\Renderer\AbstractReferenceRenderer;
use App\Service\Promotion\Renderer\Reference\Trait\PromotionContextTrait;

abstract class AbstractPromotionSupport extends AbstractReferenceRenderer
{
    use PromotionContextTrait;

    public function supports(Reference $reference): bool
    {
        return $reference instanceof PromotedReference;
    }

    public function getTemplatePath(): string
    {
        return 'price/promoted_reference.html.twig';
    }
}
