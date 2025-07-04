<?php

namespace App\Controller\Entrenadores\Baja;

use App\Service\Entrenadores\Baja\BajaEntrenadorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BajaEntrenadorController extends AbstractController
{
    public function __construct(private BajaEntrenadorService $bajaEntrenadorService)
    {}

    #[Route('/entrenadores/baja', name: 'baja_entrenadores', methods: ['PATCH'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->bajaEntrenadorService->bajaEntrenador($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Entrenador dado de baja correctamente',
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



