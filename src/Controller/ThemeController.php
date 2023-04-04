<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{
    private ThemeRepository $themeRepository;
    private SerializerInterface $serializer;
    private QuestionRepository $questionRepository;

    /**
     * @param ThemeRepository $themeRepository
     * @param SerializerInterface $serializer
     * @param QuestionRepository $questionRepository
     */
    public function __construct(ThemeRepository $themeRepository, SerializerInterface $serializer, QuestionRepository $questionRepository)
    {
        $this->themeRepository = $themeRepository;
        $this->serializer = $serializer;
        $this->questionRepository = $questionRepository;
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

        $questions =$this->questionRepository->findBy(["theme"=>$themes]);
        shuffle($questions);
        $randQuestion = array_slice($questions,0,$nbQuestions);
        $QuestionJson = $this->serializer->serialize($randQuestion, 'json' ,['groups'=>'get_question']);

        return new Response($QuestionJson , Response::HTTP_OK, ['content-type' => 'application/json']);
    }
}
