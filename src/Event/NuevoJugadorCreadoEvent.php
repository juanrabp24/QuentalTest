<?php
namespace App\Event;

use App\Entity\Jugadores;
use Symfony\Contracts\EventDispatcher\Event;

class NuevoJugadorCreadoEvent extends Event
{
    public function __construct(public Jugadores $jugador) {}

    public function getJugador(): Jugadores
    {
        return $this->jugador;
    }
}
