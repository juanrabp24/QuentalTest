<?php

namespace App\Controller\Clubes\Listado;

use App\Service\Clubes\Alta\AltaService;
use App\Service\Clubes\Listado\ListadoService;
use App\Service\Clubes\Modificar\ModificarPresupuestoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListadoJugadoresController extends AbstractController
{
    public function __construct(private ListadoService $listadoService)
    {
    }

    #[Route('/clubes/listado/jugadores', name: 'listad_jugadores_clubes', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $listadoPaginado = $this->listadoService->listadoJugadores($data);

            return new JsonResponse([
                'tipo' => 'success',
                'data' => $listadoPaginado,
                'mensaje' => 'El Listado del club se muestra correctamente',
            ], 200);

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



