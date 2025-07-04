<?php

namespace App\Controller\Clubes\Alta;

use App\Service\Clubes\Alta\AltaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AltaClubesController extends AbstractController
{
    public function __construct(private AltaService $altaService){}

    #[Route('/clubes/alta', name: 'alta_clubes', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->altaService->altaClub($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Club creado correctamente',
                200
            ]);

        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse([
                'tipo' => 'error',
                'mensaje' => $exception->getMessage(),
                200
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


