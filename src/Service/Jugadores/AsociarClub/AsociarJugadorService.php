<?php
namespace App\Service\Jugadores\AsociarClub;

use App\Entity\Clubes;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityManagerInterface;

class AsociarJugadorService
{
    public function __construct(private EntityManagerInterface $em){}

    public function asociarJugador(array $data): Jugadores
    {
        if (empty($data['club']) || empty($data['jugador'])) {
            throw new \InvalidArgumentException('Se necesitan las ids del jugador y club para poder asociar');
        }
        if (empty($data['salario'])) {
            throw new \InvalidArgumentException('Es obligatorio introducir el salario');
        }

        $jugador = $this->em->getRepository(Jugadores::class)->find($data['jugador']);
        $club = $this->em->getRepository(Clubes::class)->find($data['club']);

        if (!is_null($jugador) && !is_null($club)) {

            $jugador->setClub($club);
            $jugador->setSalario($data['salario']);
            $this->em->persist($jugador);
            $this->em->flush();

            return $jugador;
        } else {
            throw new \Exception('El jugador o el club no existen', 200);
        }

    }

}