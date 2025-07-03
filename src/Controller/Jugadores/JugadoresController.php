<?php

namespace App\Controller\Jugadores;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class JugadoresController extends AbstractController
{
    #[Route('/jugadores', name: 'app_jugadores')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/JugadoresController.php',
        ]);
    }
}
