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
}