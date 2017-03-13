<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 10:31
 */

namespace AppBundle\Manager;
use AppBundle\Entity\Favourite;
use AppBundle\Entity\Tweet;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class FavouriteManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * TweetManager constructor.
     * @param EntityManagerInterface $em
     * @param $nb_last
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(){
        return new Favourite();
    }

    public function show(User $user){
        $tweets = $this->em->getRepository(Favourite::class)->getFavourite($user);
        return $tweets;
    }

    public function addFavourite(User $user, Tweet $tweet){
        $favourite = $this->create();
        $favourite->setUser($user);
        $favourite->setTweet($tweet);
        return $favourite;
    }


    public function save(Favourite $favourite){
        $this->em->persist($favourite);
        $this->em->flush();
    }

}