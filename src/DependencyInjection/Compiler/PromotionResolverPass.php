<?php

declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use App\Service\Promotion\Processor\PromotionProcessor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PromotionResolverPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $promotionResolvers = $container->findTaggedServiceIds('promotion_resolver');

        //<editor-fold desc="get promotion resolvers + sort them with priority">
        $resolversByPriority = $this->doSortResolversByPriority($promotionResolvers);
        //</editor-fold>

        //<editor-fold desc="set the highest resolver as argument to the processor">
        $initialPromotionResolver = \array_shift($resolversByPriority);
        $processor = $container->getDefinition(PromotionProcessor::class);
        $processor->setArgument('$resolver', new Reference($initialPromotionResolver));
        //</editor-fold>

        //<editor-fold desc="setting up the chained resolvers">
        $promotionResolver = $container->getDefinition($initialPromotionResolver);
        foreach ($resolversByPriority as $resolver) {
            $resolverDefinition = $container->getDefinition($resolver);
            $promotionResolver->addMethodCall('setNextResolver', [$resolverDefinition]);
            $promotionResolver = $resolverDefinition;
        }
        //</editor-fold>
    }

    private function doSortResolversByPriority(array $promotionResolvers): array
    {
        $resolversByPriority = [];
        foreach ($promotionResolvers as $id => $attributes) {
            $priority = (int) ($attributes[0]['priority'] ?? 0);

            $resolversByPriority[$priority][] = $id;
        }
        \krsort($resolversByPriority);

        return \array_merge(...$resolversByPriority);
    }
}
