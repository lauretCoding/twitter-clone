<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\Tweet;

class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet")
     */
    public function listAction(Request $request)
    {
        $tweets = $this->getDoctrine()->getRepository(Tweet::class)->getLastTweets(
            $this->getParameter('app.tweet.nb_last',10)
        );
        return $this->render(':tweet:list.html.twig', [
            "tweets" => $tweets,
        ]);
    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view")
     */
    public function tweetAction($id)
    {
        $tweet = $this->getDoctrine()->getRepository(Tweet::class)->getTweet($id);

        if($tweet == null)
            throw new NotFoundHttpException('Ce tweet n\'existe pas');

        return $this->render(':tweet:tweet.html.twig', [
            "tweet" => $tweet,
            "date" => new \Datetime,
        ]);
    }
}

