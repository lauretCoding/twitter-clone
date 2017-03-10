<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Favourite;
use AppBundle\Entity\User;

/**
 * TweetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavouriteRepository extends \Doctrine\ORM\EntityRepository
{

    public function getFavourite(User $user){
        return $this->createQueryBuilder('f')
            ->select('f')
            ->andWhere('f.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
