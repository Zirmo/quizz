<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");
        $themes=["animaux","anime","voiture","alcool"];
        $i = 0;
        foreach ($themes as $theme){
            $object=new Theme();
            $object->setNom($theme);
            $object->setImage($faker->imageUrl(500, 300, $object->getNom(), true));
            $this->addReference("theme".$i,$object);
            $manager->persist($object);
            $i ++;
        }




        $manager->flush();

    }
}
