<?php

namespace App\Controller;

use App\Entity\Animals;
use App\Entity\Reviews;
use App\Form\ReviewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReviewsController extends AbstractController
{
    #[Route('/reviews/{id}', name: 'app_reviews')]
    public function index(Request $request, EntityManagerInterface $em, Animals $animals): Response
    {
        $reviews = new Reviews();
        $formReviews = $this->createForm(ReviewsType::class, $reviews);
        $formReviews->handleRequest($request);

        if ($formReviews->isSubmitted() && $formReviews->isValid()) {
            $reviews->setAnimals($animals);
            $em->persist($reviews);
            $em->flush();
            return $this->redirectToRoute('animals');
        }
        return $this->render('reviews/index.html.twig', [
            'form' => $formReviews
        ]);
    }

    #[Route('animals/{id}/reviews/add', name:'app_reviews_add')]
    public function create(Animals $animals)
    {
        // $revie

        // dd($animals);
    }
}
