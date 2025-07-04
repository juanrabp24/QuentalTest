<?php

namespace App\Service\Jugadores\Alta;

use App\Entity\Jugadores;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\GeneralServices\CorreoService;
class AltaService
{
    public function __construct(
        private EntityManagerInterface $em,
        private CorreoService $correo
    ){}

    public function altaJugador(array $data): Jugadores
    {
        if( empty($data['nombre']) || empty($data['apellidos']) || empty($data['dorsal']) ) {
            throw new \InvalidArgumentException('El nombre,apellidos y dorsal es obligatorio');
        }
         if(!empty($data['salario']) || !is_null($data['salario'])){
            throw new \InvalidArgumentException('El jugador solo se le puede asignar el salario una vez se haya asignado a un club');
         }

        $jugador = new Jugadores();
        $jugador->setNombre($data['nombre']);
        $jugador->setApellidos($data['apellidos']);
        $jugador->setDorsal((int)$data['dorsal']);

        $this->em->persist($jugador);
        $this->em->flush();

        $this->correo->enviar(
            'juanrabp24@gmail.com',
            'Nuevo jugador creado',
            'Se ha creado el jugador: ' . $jugador->getNombre() . ' ' . $jugador->getApellidos()
        );

        return $jugador;


    }

}