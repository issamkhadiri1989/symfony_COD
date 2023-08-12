<?php

namespace App\Controller;

use App\Service\Erp\SomeErp;
use App\Service\Promotion\Processor\PromotionProcessor;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * @param SomeErp $erpService
     * @param PromotionProcessor $processor
     *
     * @return Response
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/price', name: 'app_price')]
    public function index(SomeErp $erpService, PromotionProcessor $processor): Response
    {
        $prices = $erpService->getPrices([]);

        $resolvedReferences = $processor->resolvePromotion($prices['references']);

        return $this->render('price/index.html.twig', [
            'controller_name' => 'PriceController',
            'resolvedReferences' => $resolvedReferences,
        ]);
    }
}
