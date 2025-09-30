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

    // INDEX = Page d'accueil

    #[Route('/animals', name: 'animals')]
    public function index(AnimalsRepository $AnimalsRepository): Response
    {

        $animals = $AnimalsRepository->findAll();

        return $this->render('animals/index.html.twig', [
            'controller_name' => 'AnimalsController',
            'animals' => $animals
        ]);
    }

    // ADD = Formulaire pour ajouter un animal

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
                $file->move($this->getParameter('animals_dir'), $newFileName);
                $animal->setImg($newFileName);
               
            }

            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('animals');
        }


        return $this->render('animals/add.html.twig', [
            'titre' => "Ajout d'un animal",

            'formAnimal' => $formAnimal
        ]);
    }

    // SHOW = Voir l'animal en détail

    #[Route('/animals/{id}/show', name: 'show_animal')]
    public function show(AnimalsRepository $AnimalsRepository, int $id)
    {

        $animal = $AnimalsRepository->findOneBy(['id' => $id]);

        return $this->render('animals/show.html.twig', [
            'titre' => "Détail d'un animal",
            'animal' => $animal,
        ]);
    }

    // EDIT = Modifier un animal

    #[Route('/animals/{id}/edit', name: 'edit_animal')]
    public function edit(Animals $animals, Request $request, EntityManagerInterface $em): Response
    {
       
        $formAnimal = $this->createForm(AnimalsType::class, $animals);

        $formAnimal->handleRequest($request);

        if($formAnimal->isSubmitted() && $formAnimal->isValid()) {
            $em->flush();
            $this->addFlash('Success', 'Bravo votre animal a été modifié');
            return $this->redirectToRoute('Animals');
        }

        return $this->render('animals/edit.html.twig', [
            'titre' => "Modifier un animal",
        ]);
    }

    // DELETE = Supprimer un animal
    #[Route(path:'/animals/{id}/delete', name: 'delete')]
     public function delete(int $id, Request $request, Animals $animals, EntityManagerInterface $em)
    {

        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $em->remove($animals);
            $em->flush();
             $this->addFlash('success', 'bravo votre article a ete supprimé');

            return $this->redirectToRoute('Animals');
        } else {
            $this->addFlash('error','echec de la suppression');
            return$this->redirectToRoute('Animals');
          
        }
    }

}



 