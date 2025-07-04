<?php

namespace App\Controller\Clubes\Modificar;

use App\Service\Clubes\Alta\AltaService;
use App\Service\Clubes\Modificar\ModificarPresupuestoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModificarPresupuestoController extends AbstractController
{
    public function __construct(private ModificarPresupuestoService $modificarPresupuestoService)
    {
    }

    #[Route('/clubes/modificar/presupuesto', name: 'modificar_presupuesto_clubes', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->modificarPresupuestoService->modificarPresupuesto($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'El presupuesto del club se ha modificado correctamente',
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




