<?php

namespace App\Controller\User;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="review")
     */
    public function index(ReviewRepository $reviews): Response
    {
        if($this->getUser()){

            $user = $this->getUser()->getAccountIdentifier();
        }else{
            $user = null;
        }
        //dd($user);
        return $this->render('review/review.html.twig', [
            'controller_name' => 'ReviewController',
            'review' => $reviews->findAll(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/review/new", name="create_review")
     */
    public function createReview(Request $request, EntityManagerInterface $em){
        $new_review = new Review;
        $form = $this->createForm(ReviewType::class, $new_review);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $new_review->setUser($this->getUser()->getId());
            $new_review->setPublicationDate(new DateTime());
            $em->persist($new_review);
            $em->flush();

            return $this->redirectToRoute('review');
        }else{
            return $this->render('review/review.html.twig',[
                'form' => $form->createView(),
            ]);
        }
    }

    
}
