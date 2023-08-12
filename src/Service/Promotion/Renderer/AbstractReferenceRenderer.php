<?php

declare(strict_types=1);

namespace App\Service\Promotion\Renderer;

use App\DataTransferObject\Reference;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractReferenceRenderer implements ReferenceRendererInterface
{
    protected static int $priority = 0;

    public function __construct(protected readonly Environment $environment)
    {
    }

    public static function getPriority(): int
    {
        return static::$priority;
    }

    /**
     * @param Reference $reference
     *
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getRender(Reference $reference): string
    {
        $context = $this->getContext($reference);

        $template = $this->getTemplatePath();

        return $this->environment->render($template, $context);
    }

    abstract public function supports(Reference $reference): bool;

    abstract protected function getContext(Reference $reference): array;
}