<?php

namespace App\Manager;

use App\Entity\Dishes;
use App\Service\StripeService;
use Doctrine\ORM\EntityManagerInterface;

class OrderManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var StripeService
     */
    protected $stripeService;

    public function __construct(EntityManagerInterface $entityManager, StripeService $stripeService)
    {
        $this->em = $entityManager;
        $this->stripeService = $stripeService;
    }

    public function getAllDishes(){
        return $this->em->getRepository(Dishes::class)->findAll();
    }

    public function intentSecret(Dishes $dishes){
        
        $intent = $this->stripeService->paymentIntent($dishes);
        return $intent['client_secret'] ?? null;
    }

    public function stripe(array $stripeParameter, Dishes $dishes){
        $resource = null;
        $data = $this->stripeService->stripe($stripeParameter, $dishes);
    }
}