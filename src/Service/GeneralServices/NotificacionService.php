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


    }
}
