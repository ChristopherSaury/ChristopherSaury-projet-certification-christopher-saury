<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DishesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SelectionController extends AbstractController
{
    #[Route('/selection', name: 'selection')]
    public function selection(DishesRepository $dishRespository, CategoryRepository $catRepo, Request $request): Response
    {
        $limit = 2;

        $page = (int)$request->query->get('page', 1);

        $dishes = $dishRespository->getPaginatedDishes($page, $limit);

        $total = $dishRespository->getTotalDishes();

        $categories = $catRepo->findAll();
        //dd($subcategories);

        return $this->render('selection/index.html.twig', compact('dishes', 'limit', 'page','total', 'categories'));
    }
}
