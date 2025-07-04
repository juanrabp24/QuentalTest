<?php

namespace App\Controller\Clubes;

use App\Service\Clubes\Alta\AltaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
                'type' => 'success',
                'mensaje' => 'Club creado correctamente',
                200
            ]);

        } catch (\InvalidArgumentException $exception) {
            return new JsonResponse([
                'type' => 'error',
                'mensaje' => $exception->getMessage(),
                200
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'type' => 'error',
                'mensaje' => $exception->getMessage(),
                500
            ]);
        }

    }
}


