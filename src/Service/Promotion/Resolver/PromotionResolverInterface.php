<?php

namespace App\Service\Promotion\Resolver;

use App\DataTransferObject\Reference;

interface PromotionResolverInterface
{
    public function resolve(array $reference): Reference;
}