<?php

namespace App\DataFixtures;

use App\Entity\Drum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class DrumFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {   
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 45; $i++) {
            $drum = new Drum();
            $drum
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setModel($faker->sentences(1, true))
                ->setDimensionGc($faker->numberBetween(16, 28))
                ->setWoodtype($faker->sentences(1, true))
                ->setFuts($faker->numberBetween(3, 5))
                ->setPrice($faker->numberBetween(450, 2000));

                $manager->persist($drum);
        }

        $manager->flush();
    }
}
