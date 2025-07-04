<?php

namespace App\Service\Jugadores;

use App\Entity\Jugadores;
use Doctrine\ORM\EntityManagerInterface;

class AltaService
{
    public function __construct(private EntityManagerInterface $em){}


    public function altaJugador(array $data): Jugadores
    {
        if( empty($data['nombre']) || empty($data['apellidos']) || empty($data['dorsal']) ) {
            throw new \InvalidArgumentException('El nombre,apellidos y dorsal es obligatorio');
        }
         if(!empty($data['salario'])){
            throw new \InvalidArgumentException('El jugador solo se le puede asignar el salario una vez se haya asignado a un club');
         }

        $jugador = new Jugadores();
        $jugador->setNombre($data['nombre']);
        $jugador->setApellidos($data['apellidos']);
        $jugador->setDorsal((int)$data['dorsal']);

        $this->em->persist($jugador);
        $this->em->flush();

        return $jugador;


    }

}