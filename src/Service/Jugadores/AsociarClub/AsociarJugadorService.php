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

        if(is_null($jugador) || is_null($club)){
            throw new \Exception('El jugador o el club no existen', 200);
        }

        $total = 0;

        if(!$club->getEntrenadores()->isEmpty()){
            foreach ($club->getEntrenadores() as $entrenador) {
                $total += $entrenador->getSalario();
            }
        }

        if(!$club->getJugadores()->isEmpty()){
            foreach ($club->getJugadores() as $jugador) {
                $total += $jugador->getSalario();
            }
        }


        if ((int)$total+(int)$data['salario'] > $club->getPresupuesto()) {
            throw new \InvalidArgumentException('El salario del jugador supera el maximo del presupuesto total');
        }

        dump($jugador);
        die;

        if(!is_null($jugador->getClub())){
            throw new \InvalidArgumentException('Ese jugador ya esta asociado a otro club, para asociarlo debe estar libre');
        }

        $jugador->setClub($club);
        $jugador->setSalario($data['salario']);
        $this->em->persist($jugador);
        $this->em->flush();

        return $jugador;


    }

}