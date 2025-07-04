<?php

namespace App\Service\Jugadores\Baja;

use App\Entity\Clubes;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityManagerInterface;

class BajaJugadorService
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function bajaJugador(array $data): Jugadores
    {
        if (empty($data['club']) || empty($data['jugador'])) {
            throw new \InvalidArgumentException('Se necesitan las ids del jugador y club para poder asociar');
        }

        $jugador = $this->em->getRepository(Jugadores::class)->find($data['jugador']);
        $club = $this->em->getRepository(Clubes::class)->find($data['club']);

        if (is_null($jugador) || is_null($club)) {
            throw new \Exception('El jugador o el club no existen', 200);
        }

        $jugador->setClub(null);
        $jugador->setSalario(0);
        $this->em->persist($jugador);
        $this->em->flush();

        $this->correo->enviar(
            'juanrabp24@gmail.com',
            'Se ha dado de baja',
            'Se ha dado de baja el jugador: ' . $jugador->getNombre() . ' ' . $jugador->getApellidos()
        );

        return $jugador;


    }

}