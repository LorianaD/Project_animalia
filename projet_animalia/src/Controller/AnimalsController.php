<?php

namespace App\Controller;

use App\Entity\Animals;
use App\Form\AnimalsType;
use App\Repository\AnimalsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $animal = new Animals();
        $formAnimal = $this->createForm(AnimalsType::class, $animal);
        $formAnimal->handleRequest($request);


        if ($formAnimal->isSubmitted() && $formAnimal->isValid()) {

            $file = $formAnimal->get('img')->getData();

            if ($file) {
                $newFileName = time() . '_' . $file->getClientOriginalName();
                dd($newFileName);
                $file->move($this->getParameter('animals_dir'), $newFileName);
                $animal->setImg($newFileName);
                dd($newFileName, $animal, $file);
            }

            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('animal');
        }


        return $this->render('animals/add.html.twig', [
            'titre' => "Ajout d'un animal",

            'formAnimal' => $formAnimal
        ]);
    }
}