<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\Query\ResultSetMapping;


class ThemeController extends AbstractController
{
    private ThemeRepository $themeRepository;
    private SerializerInterface $serializer;
    private QuestionRepository $questionRepository;
    private EntityManagerInterface $entityManager;

    /**
     * @param ThemeRepository $themeRepository
     * @param SerializerInterface $serializer
     * @param QuestionRepository $questionRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ThemeRepository $themeRepository, SerializerInterface $serializer, QuestionRepository $questionRepository, EntityManagerInterface $entityManager)
    {
        $this->themeRepository = $themeRepository;
        $this->serializer = $serializer;
        $this->questionRepository = $questionRepository;
        $this->entityManager = $entityManager;
    }


    #[Route('api/themes', name: 'app_theme', methods: ['GET'])]
    public function getTheme(): Response
    {
        $themes = $this->themeRepository->findAll();
        $themeJson = $this->serializer->serialize($themes, 'json' ,['groups'=>'list_theme']);

        return new Response($themeJson, Response::HTTP_OK, ['content-type' => 'application/json']);
    }

    #[Route('api/themes/{slug}/questions/{nbQuestions}', name: 'app_theme_question', methods: ['GET'])]
    public function getThemeQuestion($slug, $nbQuestions): Response
    {

        $themes = $this->themeRepository->findBy(["slug"=>$slug]);
        if(!$themes){
            return $this->generateError("Theme inconnu",Response::HTTP_NOT_FOUND);
        }
        $sql = 'SELECT q.id, q.intitule, t.id AS theme_id, t.nom AS theme_name FROM question q JOIN theme t ON q.theme_id = t.id WHERE t.slug = :slug ORDER BY RAND() LIMIT :nb';

// create the result set mapping
        $rsm = new ResultSetMappingBuilder($this->entityManager);
        $rsm->addRootEntityFromClassMetadata(Question::class, 'q');

// create the native query
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('slug', $slug);
        $query->setParameter('nb', $nbQuestions, \PDO::PARAM_INT);

// get the results
        $questions = $query->getResult();



        if($nbQuestions >count($questions)){
            return $this->generateError("Trop de question demandé",Response::HTTP_NOT_FOUND);
        }elseif ($nbQuestions==0){
            return $this->generateError("Le nombre de question doit etre superieur à 0",Response::HTTP_NOT_FOUND);
        }
        $questionJson = $this->serializer->serialize($questions, 'json' ,['groups'=>'get_question']);

        return new Response($questionJson , Response::HTTP_OK, ['content-type' => 'application/json']);
    }

    private function generateError ( string $message, int $status){
        $erreur = [
            'status' => $status,
            'message' => $message,
        ];
        return new Response(json_encode($erreur),$status,["content-type" => "application/json"]);
    }
}
