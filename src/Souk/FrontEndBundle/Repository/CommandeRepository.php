<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 31/05/2018
 * Time: 20:05
 */

namespace Souk\FrontEndBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CommandeRepository extends EntityRepository
{ public function findCmd()
{
    $qb = $this->createQueryBuilder('u')
        ->Select('u')
        ->orderBy('u.id', 'DESC')
        ->setMaxResults( 1 );
    return $qb->getQuery()
        ->getOneOrNullResult();
}

public function CmdEnAttente()
{
    $query = $this->getEntityManager()->createQuery('SELECT CMD FROM SoukFrontEndBundle:Commande CMD  Left OUTER JOIN 
                                                                             SoukFrontEndBundle:Facture FACT
    where CMD.id = FACT.idcommande and  FACT.idcommande is NULL ')  ;
    return $query->getResult();
}

}