<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Cita;

/**
 * Description of CitaRepository
 *
 * @author Oscar Velásquez
 */
class CitaRepository extends EntityRepository {

    public function findAllByServiosProfesionales($dia) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            select e.nombre, s.dia, s.cupo, s.disponible, s.turno, s.id, s.procedencia from servicio_profesional as sp
            left join profesional as p on sp.profesional_id=p.id
            left join persona as pers on p.persona_id=pers.id
            left join servicio as s on s.id=sp.servicio_id
            left join especialidad as e on e.id=s.especialidad_id
            where sp.status=:status and s.dia=:dia';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('status' => 'activo', 'dia' => $dia));
        return $stmt->fetchAll();
    }

}
