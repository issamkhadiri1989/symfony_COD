<?php

declare(strict_types=1);

namespace App\Service\Erp;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use function file_get_contents;

class SomeErp
{
    public function __construct(private readonly ContainerBagInterface $container)
    {
    }

    /**
     * this is core service simulation.
     *
     * @param array $references
     *
     * @return array
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getPrices(array $references): array
    {
        // make an api call
        $content = file_get_contents($this->container->get('kernel.project_dir') . '/data/prices.json');

        $jsonDecoder = new JsonEncoder();

        return $jsonDecoder->decode($content, 'json');
    }
}