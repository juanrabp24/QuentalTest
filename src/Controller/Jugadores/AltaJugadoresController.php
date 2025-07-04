<?php

namespace App\Controller\Jugadores;

use App\Service\Jugadores\Alta\AltaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AltaJugadoresController extends AbstractController
{
    public function __construct(private AltaService $altaService){}

    #[Route('/jugadores/alta', name: 'alta_jugadores', methods: ['POST'])]

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try{
            $this->altaService->altaJugador($data);

            return new JsonResponse([
                'type' => 'success',
                'mensaje' => 'Jugador creado correctamente',
                200
            ]);

        }catch (\InvalidArgumentException $exception){
            return new JsonResponse([
                'type' => 'error',
                'mensaje' => $exception->getMessage(),
                200
            ]);
        }catch (\Exception $exception){
            return new JsonResponse([
                'type' => 'error',
                'mensaje' => $exception->getMessage(),
                500
            ]);
        }

    }
}
