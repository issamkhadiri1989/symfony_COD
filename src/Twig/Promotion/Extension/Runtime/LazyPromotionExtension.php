<?php

declare(strict_types=1);

namespace App\Twig\Promotion\Extension\Runtime;

use App\DataTransferObject\Reference;
use App\Service\Promotion\Renderer\AbstractReferenceRenderer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedLocator;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\RuntimeExtensionInterface;

final class LazyPromotionExtension implements RuntimeExtensionInterface
{
    /**
     * @param ServiceLocator $container
     */
    public function __construct(
        #[TaggedLocator(
            tag: 'promotion_renderer',
            defaultPriorityMethod: 'getPriority'
        )] private readonly ContainerInterface $container
    ) {
    }

    /**
     * @param Reference $reference
     *
     * @return string
     *
     * @throws ContainerExceptionInterface
     * @throws LoaderError
     * @throws NotFoundExceptionInterface
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderPromotion(Reference $reference): string
    {
        $providedServices = $this->container->getProvidedServices();

        /** @var AbstractReferenceRenderer $renderer */
        $renderer = null;

        foreach ($providedServices as $service) {
            $renderer = $this->container->get($service);
            if ($renderer->supports($reference) === true) {
                break;
            }
        }

        return $renderer->getRender($reference);
    }
}