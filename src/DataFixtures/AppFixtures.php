<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create(locale:'fr_FR');

        for ($i = 0; $i < 50; $i++) {
        $recipe = new Recipe();
        $recipe
            ->setName($faker->words(15, true));

        $manager->persist($recipe); // Je notifie le gestionnaire d'objets que je souhaite qu'il gère cet objet
        $manager->flush(); // Envoyer les modifications en BDD
    }}
}
