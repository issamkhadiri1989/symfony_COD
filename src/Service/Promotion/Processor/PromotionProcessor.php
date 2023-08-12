<?php

declare(strict_types=1);

namespace App\Service\Promotion\Processor;

use App\Service\Promotion\Resolver\PromotionResolverInterface;

final class PromotionProcessor
{
    public function __construct(private readonly PromotionResolverInterface $resolver)
    {
    }

    public function resolvePromotion(array $references): array
    {
        $resolvedReferences = [];
        foreach ($references as $reference) {
            $resolvedReferences[] = $this->resolver->resolve($reference);
        }

        return $resolvedReferences;
    }
}
