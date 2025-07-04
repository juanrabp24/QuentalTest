<?php

namespace App\Controller\Jugadores\Asociacion;

use App\Service\Jugadores\AsociarClub\AsociarJugadorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AsociacionJugadorController extends AbstractController
{
    public function __construct(private AsociarJugadorService $asociarJugadorService){}

    #[Route('/jugadores/asociar', name: 'asociar_jugadores', methods: ['PATCH'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->asociarJugadorService->asociarJugador($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Jugador asociado correctamente',
                200
            ]);

        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse([
                'tipo' => 'error',
                'mensaje' => $exception->getMessage(),
                500
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'tipo' => 'error',
                'mensaje' => $exception->getMessage(),
                500
            ]);
        }

    }
}



