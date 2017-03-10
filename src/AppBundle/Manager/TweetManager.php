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
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var
     */
    private $nb_last;

    /**
     * TweetManager constructor.
     * @param EntityManagerInterface $em
     * @param $nb_last
     */
    public function __construct(EntityManagerInterface $em, $nb_last)
    {
        $this->em = $em;
        $this->nb_last = $nb_last;
    }

    /**
     * @return Tweet
     */
    public function create(){
        return new Tweet();
    }

    /**
     * @param $tweet
     */
    public function save($tweet){
        if(null === $tweet->getId())
            $this->em->persist($tweet);
        $this->em->flush();
    }

    /**
     * @return array
     */
    public function getLast(){
        $tweets = $this->em->getRepository(Tweet::class)->getLastTweets($this->nb_last);
        return $tweets;
    }
}