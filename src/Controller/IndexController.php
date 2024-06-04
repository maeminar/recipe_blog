<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/recipe', name: 'app_recipe')]
    public function allrecipes(RecipeRepository $Allrecips): Response
    {
        $Allrecips = $Allrecips->findAll();
        return $this->render('index/recipe.html.twig', [
            'Allrecipes' => $Allrecips,
        ]);
    }
}
