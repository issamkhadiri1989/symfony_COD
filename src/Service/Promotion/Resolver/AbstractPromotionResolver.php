<?php

declare(strict_types=1);

namespace App\Service\Promotion\Resolver;

use App\DataTransferObject\Availability;
use App\DataTransferObject\PromotedReference;
use App\DataTransferObject\Promotion\PromotionInterface;
use App\DataTransferObject\Reference;

/**
 * Chain of Responsibility.
 */
abstract class AbstractPromotionResolver implements PromotionResolverInterface
{
    private ?PromotionResolverInterface $resolver = null;

    public function setNextResolver(?PromotionResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    public function createReference(array $input): Reference
    {
        $reference = new Reference();
        $this->setReferenceCommonData($input, $reference);

        return $reference;
    }

    /**
     * Sets the defaults / common attributes.
     *
     * @param array $input
     * @param Reference $reference
     *
     * @return void
     */
    protected function setReferenceCommonData(array $input, Reference $reference): void
    {
        $reference->setReference($input['reference']);
        $reference->setAvailability((new Availability())->setAvailable($input['availability']['available']));
        $reference->setPrice($input['net_price']);
        $reference->setProductName($input['product_name']);
        $reference->setImage($input['image']);
        $reference->setDescription($input['description'] ?? '');
    }

    public function resolveReference(array $reference): Reference
    {
        if (!$this->resolver) {
            $defaultReference = new Reference();
            $this->setReferenceCommonData($reference, $defaultReference);

            return $defaultReference;
        }

        // next resolver to be used
        return $this->resolver->resolve($reference);
    }

    public function buildPromotedReferenceInstance(array $input, PromotionInterface $promotion): Reference
    {
        $promotedReference = new PromotedReference();
        $this->setReferenceCommonData($input, $promotedReference);
        $promotedReference->setPromotion($promotion);

        return $promotedReference;
    }
}