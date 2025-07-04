<?php

namespace App\Service\Clubes\Modificar;

use App\Entity\Clubes;
use App\Entity\Entrenadores;
use Doctrine\ORM\EntityManagerInterface;

class ModificarPresupuestoService
{
    public function __construct(private EntityManagerInterface $em){}


    public function modificarPresupuesto(array $data): Clubes
    {
        if (empty($data['club'])) {
            throw new \InvalidArgumentException('Se necesita la id del club para poder modificar el presupuesto');
        }
        $salario = 0;

        $club = $this->em->getRepository(Clubes::class)->find($data['club']);

        if (is_null($club)) {
            throw new \Exception('El club no existe', 200);
        }

        if(!$club->getEntrenadores()->isEmpty()){
            foreach ($club->getEntrenadores() as $entrenador) {
                $salario += $entrenador->getSalario();
            }
        }

        if(!$club->getJugadores()->isEmpty()){
            foreach ($club->getJugadores() as $jugador) {
                $salario += $jugador->getSalario();
            }
        }

        if ($data['presupuesto'] < $salario) {
            throw new \InvalidArgumentException('El salario de los jugadores y entrenadores es mayor que el presupuesto');
        }

        $club->setPresupuesto($data['presupuesto']);

        $this->em->persist($club);
        $this->em->flush();

        return $club;

    }

}