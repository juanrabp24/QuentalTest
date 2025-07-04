<?php

namespace App\Controller\Jugadores\Alta;

use App\Service\Jugadores\Alta\AltaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AltaJugadoresController extends AbstractController
{
    public function __construct(private AltaService $altaService){}

    #[Route('/jugadores/alta', name: 'alta_jugadores', methods: ['POST'])]

    /*
    * Esta funcionalidad le pasa al servicio los params enviados por postman, las recojo con el request y las envía al servicio donde se tratan
    * Da de alta a un Jugador
    * */
    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try{
            $this->altaService->altaJugador($data);

            return new JsonResponse([
                'tipo' => 'success',
                'mensaje' => 'Jugador creado correctamente',
                200
            ]);

        }catch (\InvalidArgumentException $exception){
            return new JsonResponse([
                'tipo' => 'error',
                'mensaje' => $exception->getMessage(),
                500
            ]);
        }catch (\Exception $exception){
            return new JsonResponse([
                'tipo' => 'error',
                'mensaje' => $exception->getMessage(),
                500
            ]);
        }

    }
}
