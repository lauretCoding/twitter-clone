<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 08/03/2017
 * Time: 12:40
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

use AppBundle\Entity\Tweet;

class LoadTweetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $messages = [
            'hello world',
            'symfony its cool',
            'toto',
            'tata',
            'titi',
        ];

        foreach ($messages as $i => $message) {
            $tweet = new Tweet();
            $tweet->setMessage($message);

            $manager->persist($tweet);

            $this->addReference('tweet-'.$i, $tweet);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}