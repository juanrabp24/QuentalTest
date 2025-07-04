<?php

namespace App\Service\Entrenadores\AsociarClub;

use App\Entity\Clubes;
use App\Entity\Entrenadores;
use Doctrine\ORM\EntityManagerInterface;

class AsociarEntrenadorService
{
    public function __construct(private EntityManagerInterface $em){}


    public function asociarEntrenador(array $data): Entrenadores
    {
        if (empty($data['club']) || empty($data['entrenador'])) {
            throw new \InvalidArgumentException('Se necesitan las ids del entrenador y club para poder asociar');
        }
        if (empty($data['salario'])) {
            throw new \InvalidArgumentException('Es obligatorio introducir el salario');
        }


        $entrenador = $this->em->getRepository(Entrenadores::class)->find($data['entrenador']);
        $club = $this->em->getRepository(Clubes::class)->find($data['club']);


        if(is_null($entrenador) || is_null($club)){
            throw new \Exception('El entrenador o el club no existen',200);
        }

        $total = 0;

        if(!$club->getEntrenadores()->isEmpty()){
            foreach ($club->getEntrenadores() as $entrenadorSalario) {
                $total += $entrenadorSalario->getSalario();
            }
        }

        if(!$club->getJugadores()->isEmpty()){
            foreach ($club->getJugadores() as $jugadorSalario) {
                $total += $jugadorSalario->getSalario();
            }
        }

        if ((int)$total+(int)$data['salario'] > $club->getPresupuesto()) {
            throw new \InvalidArgumentException('El salario del Entrenador supera el maximo del presupuesto total');
        }
        if(!is_null($entrenador->getClub())){
            throw new \InvalidArgumentException('Ese entrenador ya esta asociado a otro club, para asociarlo debe estar libre');
        }

        $entrenador->setClub($club);
        $entrenador->setSalario($data['salario']);
        $this->em->persist($entrenador);
        $this->em->flush();

        return $entrenador;

    }

}