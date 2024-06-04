<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const NB_ARTICLES = 20;
    private const CATEGORIES = ["Végan", "Végé", "Soupe", "Salade", "Burger", "Smoothie"];
        public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create(locale:'fr_FR');

        $categories = [];

        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < self::NB_ARTICLES; $i++) {
            $recipe = new Recipe();
            $recipe
                ->setName($faker->words($faker->numberBetween(4, 7), true))
                ->setDescription($faker->varchar(255))
                ->setCategory($faker->randomElement($categories));// Obligatoire pour ajouter un ID aléatoire dans ma table 

            $manager->persist($recipe);
        }

        // Envoyer les modifications en base de données
        $manager->flush();
    }
}