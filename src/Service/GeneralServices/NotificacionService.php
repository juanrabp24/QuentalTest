<?php
namespace App\Service\GeneralServices;

use App\Entity\Notificacion;
use Doctrine\ORM\EntityManagerInterface;

class NotificacionService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function crear(string $titulo, string $mensaje, ?string $tipo = null): void
    {
        $notificacion = new Notificacion();
        $notificacion->setTitulo($titulo);
        $notificacion->setMensaje($mensaje);
        $notificacion->setCategoria($tipo);
        $notificacion->setFecha(new \DateTime('now'));

        $this->em->persist($notificacion);
        $this->em->flush();

        /*
         * He hecho el evento Listener para que cuando se de de alta un jugador se registre, esto podria adaptarse a cualquier funcionalidad para que se registren notificaciones y se envien por el metodo que se quiera.
         * Una vez creada la notificación aquí se deberia enviar via Telegram,Whats app cualquier canal que se quiera via API entiendo...
         * Siento la interpretación de un sistema de notificacion no he hecho casi pero creo que debería funcionar así, más o menos
         * */


    }
}
