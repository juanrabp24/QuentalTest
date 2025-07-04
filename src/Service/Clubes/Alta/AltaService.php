<?php
namespace App\Service\Clubes\Alta;

use App\Entity\Clubes;
use Doctrine\ORM\EntityManagerInterface;

class AltaService
{
    public function __construct(private EntityManagerInterface $em){}


    public function altaClub(array $data): Clubes
    {
        if (empty($data['nombre']) || empty($data['estadio']) || empty($data['liga'])) {
            throw new \InvalidArgumentException('El nombre,estadio y la liga a la que pertenece es obligatorio');
        }
        if (empty($data['presupuesto']) || is_null($data['presupuesto'])) {
            throw new \InvalidArgumentException('Para crear el club tienes que asignar un presupuesto');
        }

        $club = new Clubes();
        $club->setNombre($data['nombre']);
        $club->setEstadio($data['estadio']);
        $club->setLiga($data['liga']);
        $club->setPresupuesto($data['presupuesto']);

        $this->em->persist($club);
        $this->em->flush();

        return $club;


    }

}