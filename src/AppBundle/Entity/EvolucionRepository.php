<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Evolucion;

/**
 * Description of EvolucionRepository
 *
 * @author Oscar Velásquez
 */
class EvolucionRepository extends EntityRepository {

    public function findAllByConsulta($paciente, $especialidad) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'select c.fecha, e.* from evolucion as e left join consulta as c on c.id=e.consulta_id where c.paciente_id=:paciente and c.egreso=false and c.especialidad_id=:especialidad order by c.fecha asc';
        $stmt = $conn->prepare($sql);
        
        $stmt->execute(array('especialidad' => $especialidad,'paciente' => $paciente));       
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
