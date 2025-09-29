<?php

namespace App\Controller;

use App\Repository\AnimalsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AnimalsController extends AbstractController
{
    #[Route('/animals', name: 'animals')]
    public function index(AnimalsRepository $AnimalsRepository): Response
    {

        $animals = $AnimalsRepository->findAll();

        return $this->render('animals/index.html.twig', [
            'controller_name' => 'AnimalsController',
            'animals' => $animals
        ]);
    }

    #[Route('/animals/add', name: 'add_animals')]
    public function add(): Response
    {

        

        return $this->render('animals/add.html.twig', [
            'titre' => "Ajout d'un animal",
        ]);
    }
}