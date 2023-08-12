<?php

namespace App\Service\Promotion\Renderer\Reference\Trait;

use App\DataTransferObject\Reference;

trait PromotionContextTrait
{
    protected function getContext(Reference $reference): array
    {
        return [
            'reference' => $reference,
        ];
    }
}