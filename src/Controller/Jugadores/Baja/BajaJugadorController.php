<?php
namespace App\Controller\Jugadores\Baja;

use App\Service\Jugadores\Baja\BajaJugadorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BajaJugadorController extends AbstractController
{
    public function __construct(private BajaJugadorService $bajaJugadorService){}

    #[Route('/jugadores/baja', name: 'baja_jugadores', methods: ['PATCH'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->bajaJugadorService->bajaJugador($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Jugador dado de baja correctamente',
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



