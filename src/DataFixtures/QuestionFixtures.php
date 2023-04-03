<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $questions= [
            [ 'intituler' => 'qu\'elle animal fais meuh' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Comment on fais les bébés' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Qui mange son marie' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'quelle animal est willy dans sauvé willy' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'qui vient de chine' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],

        ];
        foreach ($questions as $question){
            $object = new Question();
            $object->setIntitule($question['intituler']);
            $object->setImage($question['image']);
            $object->setTheme($question['theme_id']);
            $manager->persist($object);
        }

        $manager->flush();
    }
    public function getDependencies(){
        return [
            ThemeFixtures::class
        ];
    }
}
