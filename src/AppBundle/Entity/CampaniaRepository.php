<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Cita;

/**
 * Description of CampaniaRepository
 *
 * @author Oscar Velásquez
 */
class CampaniaRepository extends EntityRepository {

    public function findAllByLasImagenes($campania) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            select 
                imagen_id as imagen 
            from 
                campania_imagen 
            where 
                campania_id=:campania
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('campania' => $campania));
        return $stmt->fetchAll();
    }
    
     
}
