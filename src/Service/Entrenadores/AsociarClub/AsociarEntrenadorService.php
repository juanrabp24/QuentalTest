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

        if(!is_null($entrenador) && !is_null($club)){

            $entrenador->setClub($club);
            $entrenador->setSalario($data['salario']);
            $this->em->persist($entrenador);
            $this->em->flush();

            return $entrenador;
        }else{
            throw new \Exception('El entrenador o el club no existen',200);
        }

    }

}