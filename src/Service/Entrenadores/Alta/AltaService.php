<?php
namespace App\Service\Entrenadores\Alta;

use App\Entity\Entrenadores;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\GeneralServices\CorreoService;


class AltaService
{
    public function __construct(
        private EntityManagerInterface $em,
        private CorreoService $correo
    ){}


    public function altaEntrenador(array $data): Entrenadores
    {
        if (empty($data['nombre']) || empty($data['apellidos'])) {
            throw new \InvalidArgumentException('El nombre,apellidos y dorsal es obligatorio');
        }
        if (!empty($data['salario']) || !is_null($data['salario'])) {
            throw new \InvalidArgumentException('El entrenador solo se le puede asignar el salario una vez se haya asignado a un club');
        }

        $entrenador = new Entrenadores();
        $entrenador->setNombre($data['nombre']);
        $entrenador->setApellidos($data['apellidos']);

        $this->em->persist($entrenador);
        $this->em->flush();

        $this->correo->enviar(
            'juanrabp24@gmail.com',
            'Nuevo Entrenador creado',
            'Se ha creado el jugador: ' . $jugador->getNombre() . ' ' . $jugador->getApellidos()
        );

        return $entrenador;


    }

}