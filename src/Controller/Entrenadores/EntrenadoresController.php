<?php

namespace App\Controller\Entrenadores;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EntrenadoresController extends AbstractController
{
    #[Route('/entrenadores', name: 'app_entrenadores')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EntrenadoresController.php',
        ]);
    }
}
