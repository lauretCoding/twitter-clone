<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 10:31
 */

namespace AppBundle\Manager;
use AppBundle\Entity\Tweet;
use Doctrine\ORM\EntityManagerInterface;

class TweetManager
{
    private $em;
    private $nb_last;

    public function __construct(EntityManagerInterface $em, $nb_last)
    {
        $this->em = $em;
        $this->nb_last = $nb_last;
    }

    public function create(){
        return new Tweet();
    }

    public function save($tweet){
        $this->em->persist($tweet);
        $this->em->flush();
    }

    public function getLast(){
        $tweets = $this->em->getRepository(Tweet::class)->getLastTweets($this->nb_last);
        return $tweets;
    }
}