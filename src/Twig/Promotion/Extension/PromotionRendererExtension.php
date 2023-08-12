<?php

declare(strict_types=1);

namespace App\Twig\Promotion\Extension;

use App\Twig\Promotion\Extension\Runtime\LazyPromotionExtension;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class PromotionRendererExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('renderReference', [LazyPromotionExtension::class, 'renderPromotion']),
        ];
    }
}