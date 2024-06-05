<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\AddRecipeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddRecipeController extends AbstractController
{
    #[Route('/add/recipe', name: 'app_add_recipe')]
    public function addrecipe(Request $request, EntityManagerInterface $em): Response
    {
        $addRecipe = new Recipe();
        $form = $this->createForm(AddRecipeType::class, $addRecipe); // Pour créer le formulaire

        $form->handleRequest(request: $request);

        if ($form->isSubmitted())   //Vérification de la validité du formulaire
        { 
            //$recipe->setCreatAt(new :\DateTime));    Si j'avais une date il faudrait ajouter ça pour qu'il ajouter automatiquement la date lors de la création d'un article
            $em->persist($addRecipe);
            $em->flush();
            return $this->redirectToRoute('addok');
        }

        return $this->render('add_recipe/addrecipe.html.twig', [
            'recipeForm' => $form
        ]);
    }

    #[Route('/add_recipe/addok', name: 'addok')]
    public function addok(): Response
    {
        return $this->render('add_recipe/addokrecipe.html.twig');
    }
}
