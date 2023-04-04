<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class ThemeFixtures extends Fixture
{
    private SluggerInterface $slugger;

    /**
     * @param SluggerInterface $slugger
     */
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");
        $themes=["animaux","anime","voiture","alcool"];
        $i = 0;
        foreach ($themes as $theme){
            $object=new Theme();
            $object->setNom($theme);
            $object->setImage($faker->imageUrl(500, 300, $object->getNom(), true));
            $object->setSlug($this->slugger->slug($object->getNom()));
            $this->addReference("theme".$i,$object);

            $manager->persist($object);
            $i ++;
        }




        $manager->flush();

    }
}
