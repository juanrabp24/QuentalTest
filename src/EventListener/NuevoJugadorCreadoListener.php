<?php

// src/EventListener/NuevoJugadorCreadoListener.php
namespace App\EventListener;

use App\Event\NuevoJugadorCreadoEvent;
use App\Service\GeneralServices\NotificacionService;

class NuevoJugadorCreadoListener
{
    public function __construct(private NotificacionService $notificador) {}

    public function __invoke(NuevoJugadorCreadoEvent $event): void
    {
        $jugador = $event->getJugador();
        $this->notificador->crear(
            'Nuevo jugador creado',
            sprintf('El jugador %s %s ha sido creado.', $jugador->getNombre(), $jugador->getApellidos()),
            'jugador'
        );
    }
}
