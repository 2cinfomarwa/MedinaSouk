<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/05/2018
 * Time: 09:44
 */

namespace Souk\FrontEndBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProduitRepository extends EntityRepository
{
    public function findArray($array)
    {
        $qb = $this->createQueryBuilder('u')
            ->Select('u')
            ->Where('u.id IN (:array)')
            ->setParameter('array', $array);
        return $qb->getQuery()->getResult();
    }
}