<?php

namespace App\Controller;

use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{
    private ThemeRepository $themeRepository;
    private SerializerInterface $serializer;

    /**
     * @param ThemeRepository $themeRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(ThemeRepository $themeRepository, SerializerInterface $serializer)
    {
        $this->themeRepository = $themeRepository;
        $this->serializer = $serializer;
    }


    #[Route('/themes', name: 'app_theme', methods: ['GET'])]
    public function getTheme(): Response
    {
        $themes = $this->themeRepository->findAll();
        $themeJson = $this->serializer->serialize($themes, 'json');

        return new Response($themeJson, Response::HTTP_OK, ['content-type' => 'application/json']);
    }
}
