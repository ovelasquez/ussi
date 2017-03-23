<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Esperando;

/**
 * Description of EsperandoRepository
 *
 * @author Oscar Velásquez
 */
class EsperandoRepository extends EntityRepository {

    public function findAllByFecha() {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'select * from esperando  where  fecha_registro >= current_date order by posicion asc';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
