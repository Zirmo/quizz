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
            [ 'intituler' => 'Comment on dresse un chien' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Qui mange son marie' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'quel animal est willy dans sauvez willy' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'qui vient de chine' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'qui à une queue' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'qui mange de l\'herbe' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Ou trouve ton les panda' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Que mange les chiens' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'A qui est ce caca' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Comment appelle t-on le marie de la brebis' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Qu\'elle est la meilleur partie du poulet' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Quel animal est le plus mangé' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Qui sent le posterieur des autres ' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Quel insecte vol' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Comment les abeilles font le miel' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'A qui doit on de l\'argent' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Combien de couleur possede les guepes' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Combien de doigts on les singes' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],
            [ 'intituler' => 'Combien de steack fais t-on avec une vache' , 'image' => '' , 'theme_id' => $this->getReference("theme".(0))],

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
