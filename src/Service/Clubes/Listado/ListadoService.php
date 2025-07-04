<?php

namespace App\Service\Clubes\Listado;

use App\Entity\Clubes;
use App\Entity\Jugadores;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


class ListadoService
{
    public function __construct(private EntityManagerInterface $em, private PaginatorInterface $paginacion){}


    public function listadoJugadores(array $data): Array
    {
        $repo = $this->em->getRepository(Jugadores::class);
        $qb = $repo->createQueryBuilder('j');

        if (!empty($data['club'])) {
            $qb->andWhere('j.club = :club')
                ->setParameter('club', $data['club']);
        }

        if (!empty($data['nombre'])) {
            $qb->andWhere('j.nombre LIKE :nombre')
                ->setParameter('nombre', '%' . $data['nombre'] . '%');
        }

        $pagination = $this->paginacion->paginate($qb, $data['pagina'] ?? 1, 10);

        $aux = [];

        foreach ($pagination->getItems() as $jugadores){

            $aux[] = [
                "id" => $jugadores->getId(),
                "nombre" => $jugadores->getNombre(),
                "apellidos" => $jugadores->getApellidos(),
                "dorsal" => $jugadores->getDorsal(),
                "salario" => $jugadores->getSalario(),
                "club" => $jugadores->getClub() ? $jugadores->getClub()->getNombre() : 'Sin club',
            ];

         }

        return $aux;

    }

}