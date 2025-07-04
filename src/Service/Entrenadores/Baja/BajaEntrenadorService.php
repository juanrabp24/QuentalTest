<?php
namespace App\Service\Entrenadores\Baja;

use App\Entity\Clubes;
use App\Entity\Entrenadores;
use Doctrine\ORM\EntityManagerInterface;

class BajaEntrenadorService
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function bajaEntrenador(array $data): Entrenadores
    {
        if (empty($data['club']) || empty($data['entrenador'])) {
            throw new \InvalidArgumentException('Se necesitan las ids del entrenador y club para poder dar de baja');
        }

        $entrenador = $this->em->getRepository(Entrenadores::class)->find($data['entrenador']);
        $club = $this->em->getRepository(Clubes::class)->find($data['club']);

        if (is_null($entrenador) || is_null($club)) {
            throw new \Exception('El entrenador o el club no existen', 200);
        }


        $entrenador->setClub(null);
        $entrenador->setSalario(0);
        $this->em->persist($entrenador);
        $this->em->flush();

        return $entrenador;


    }

}