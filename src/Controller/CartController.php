<?php

namespace App\Controller;

use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session, DishesRepository $dishesRepository): Response
    {
        $cart = $session->get("cart", []);

        $cartData = [];
        $total = 0;

        foreach($cart as $id => $quantity){
            $dish = $dishesRepository->find($id);
            $cartData[] = [
                "dish" => $dish,
                "quantity" => $quantity,
            ];
            $total += $dish->getPrice() * $quantity;
        }
        return $this->render('cart/index.html.twig', compact("cartData", "total"));
    }
    /**
     * @Route("/add/{id}", name="add")
     */
    public function add (Dishes $dish, SessionInterface $session){
        $cart = $session->get("cart", []);
        $id = $dish->getId();
        
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }

        $session->set("cart", $cart);
        
        return $this->redirectToRoute("cart_index");
    }
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Dishes $dish, SessionInterface $session){
        $cart = $session->get("cart", []);
        $id = $dish->getId();
        
        if(!empty($cart[$id])){
            if($cart[$id] > 1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
        }

        $session->set("cart", $cart);
        
        return $this->redirectToRoute("cart_index");
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Dishes $dish, SessionInterface $session){
        $cart = $session->get("cart", []);
        $id = $dish->getId();
        
        if(!empty($cart[$id])){
            unset($cart[$id]);
            }

            $session->set("cart", $cart);
            
            return $this->redirectToRoute("cart_index");
        }
    /**
     * @Route("/delete-all", name="delete_all")
     */
    public function deleteCart(SessionInterface $session){
        $cart = $session->get("cart", []);
        
            unset($cart);

            $session->remove("cart", []);
            
            return $this->redirectToRoute("cart_index");
        }
}


