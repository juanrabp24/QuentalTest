<?php

namespace App\Controller\Entrenadores\Alta;

use App\Service\Entrenadores\Alta\AltaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AltaEntrenadoresController extends AbstractController
{
    public function __construct(private AltaService $altaService){}

    #[Route('/entrenadores/alta', name: 'alta_entrenadores', methods: ['POST'])]

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->altaService->altaEntrenador($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Entrenador creado correctamente',
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

