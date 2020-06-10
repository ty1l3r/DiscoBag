<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker =Factory::create('fr_FR');

        //Créer des utilisateurs
        //Créer réseaux social par user
        //Créer un Set par utilisateurs






        $manager->flush();
    }
}
