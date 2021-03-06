<?php

namespace Creavo\MultiAppBundle\Repository;
use Creavo\MultiAppBundle\Entity\Activity;

/**
 * ActivityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActivityRepository extends \Doctrine\ORM\EntityRepository {

    public function getPreviousActivity(Activity $activity, array $types=[]) {

        $qb=$this->createQueryBuilder('a');

        $qb
            ->andWhere('a.item = :item')
            ->setParameter('item',$activity->getItem())
            ->andWhere('a.id < :id')
            ->setParameter('id',$activity->getId())
            ->setMaxResults(1)
            ->addOrderBy('a.id','desc')
        ;

        if(count($types)>0) {
            $qb
                ->andWhere('a.type IN (:types)')
                ->setParameter('types',$types);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getNextActivity(Activity $activity, array $types=[]) {


        $qb=$this->createQueryBuilder('a');

        $qb
            ->andWhere('a.item = :item')
            ->setParameter('item',$activity->getItem())
            ->andWhere('a.id > :id')
            ->setParameter('id',$activity->getId())
            ->setMaxResults(1)
            ->addOrderBy('a.id','asc')
        ;

        if(count($types)>0) {
            $qb
                ->andWhere('a.type IN (:types)')
                ->setParameter('types',$types);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

}
