<?php

namespace App\Controller;

use App\Repository\DishesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SelectionController extends AbstractController
{
    #[Route('/selection', name: 'selection')]
    public function selection(DishesRepository $respository): Response
    {
        $dishes = $respository->findAll();
        return $this->render('selection/index.html.twig', [
            'controller_name' => 'SelectionController',
            'dishes' => $dishes,
        ]);
    }
}
