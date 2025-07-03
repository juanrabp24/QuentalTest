<?php

namespace App\Controller\Clubes;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ClubesController extends AbstractController
{
    #[Route('/clubes', name: 'app_clubes')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClubesController.php',
        ]);
    }
}
