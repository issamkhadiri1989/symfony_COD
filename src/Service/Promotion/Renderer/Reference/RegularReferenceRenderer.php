<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer\Reference;

use App\DataTransferObject\Reference;
use App\Service\Promotion\Renderer\AbstractReferenceRenderer;
use App\Service\Promotion\Renderer\Reference\Trait\PromotionContextTrait;

final class RegularReferenceRenderer extends AbstractReferenceRenderer
{
    use PromotionContextTrait;

    public function supports(Reference $reference): bool
    {
        return true;
    }

    public function getTemplatePath(): string
    {
        return 'price/default_reference.html.twig';
    }
}
