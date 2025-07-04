<?php

namespace App\EventSubscriber;

use App\Event\NuevoJugadorCreadoEvent;
use App\Service\GeneralServices\NotificacionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NotificacionSubscriber implements EventSubscriberInterface
{
    public function __construct(private NotificacionService $notificador) {}

    public static function getSubscribedEvents(): array
    {
        return [
            NuevoJugadorCreadoEvent::class => 'onJugadorCreado',
        ];
    }

    public function onJugadorCreado(NuevoJugadorCreadoEvent $event): void
    {
        $this->notificador->crear(
            'Jugador creado',
            'Se ha creado: ' . $event->jugador->getNombre(),
            'Crear: Jugador'
        );
    }
}
