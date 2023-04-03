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
        [ 'intituler' => 'avec zizi' , 'correct' => '1' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on fais les bébés'])],
        [ 'intituler' => 'avec un baton' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on fais les bébés'])],
        [ 'intituler' => 'avec des chips' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on fais les bébés'])],
        [ 'intituler' => 'avec capote' , 'correct' => '0' , 'question_id' => $this->questionRepository->findOneBy(["intitule" => 'Comment on fais les bébés'])],

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
