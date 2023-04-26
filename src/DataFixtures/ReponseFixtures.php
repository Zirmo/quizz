<?php

namespace App\DataFixtures;

use App\Entity\Reponse;
use App\Repository\QuestionRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReponseFixtures extends Fixture implements DependentFixtureInterface
{
    private QuestionRepository $questionRepository;

    /**
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        $reponses= [
        [ 'intituler' => 'vache' , 'correct' => '1' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => "qu'elle animal fais meuh"])],
        [ 'intituler' => 'chevre' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => "qu'elle animal fais meuh"])],
        [ 'intituler' => 'cochon' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => "qu'elle animal fais meuh"])],
        [ 'intituler' => 'poulet' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => "qu'elle animal fais meuh"])],

        [ 'intituler' => 'avec ca bouche' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on dresse un chien'])],
        [ 'intituler' => 'avec un baton' , 'correct' => '1' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on dresse un chien'])],
        [ 'intituler' => 'avec des chips' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on dresse un chien'])],
        [ 'intituler' => 'avec la main' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on dresse un chien'])],

        [ 'intituler' => 'chien' , 'correct' => '1' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Qui mange son marie'])],
        [ 'intituler' => 'chat' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Qui mange son marie'])],
        [ 'intituler' => 'mante-religieuse' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Qui mange son marie'])],
        [ 'intituler' => 'toi' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Qui mange son marie'])],

        [ 'intituler' => 'dauphin' , 'correct' => '1' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'quel animal est willy dans sauvez willy'])],
        [ 'intituler' => 'autruche' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'quel animal est willy dans sauvez willy'])],
        [ 'intituler' => 'clebard' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'quel animal est willy dans sauvez willy'])],
        [ 'intituler' => 'chipster' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'quel animal est willy dans sauvez willy'])],

    ];

        foreach ($reponses as $reponse){
            $object = new Reponse();
            $object->setIntutile($reponse['intituler']);
            $object->setCorrect($reponse['correct']);
            $object->addQuestion($reponse['question_id']);
            $manager->persist($object);
        }

        $manager->flush();
    }
    public function getDependencies(){
        return [
            QuestionFixtures::class
        ];
    }
}
