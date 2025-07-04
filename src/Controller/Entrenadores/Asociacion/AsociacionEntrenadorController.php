<?php

namespace App\Controller\Entrenadores\Asociacion;


use App\Service\Entrenadores\AsociarClub\AsociarEntrenadorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AsociacionEntrenadorController extends AbstractController
{
    public function __construct(private AsociarEntrenadorService $asociarEntrenadorService){}

    #[Route('/entrenadores/asociar', name: 'asociar_entrenadores', methods: ['PATCH'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->asociarEntrenadorService->asociarEntrenador($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Entrenador asociado correctamente',
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


