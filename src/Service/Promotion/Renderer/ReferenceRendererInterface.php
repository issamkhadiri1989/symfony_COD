<?php

namespace App\Service\Promotion\Renderer;

use App\DataTransferObject\Reference;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

#[Autoconfigure(tags: ['promotion_renderer'])]
interface ReferenceRendererInterface
{
    public function supports(Reference $reference): bool;

    public function getTemplatePath(): string;
}