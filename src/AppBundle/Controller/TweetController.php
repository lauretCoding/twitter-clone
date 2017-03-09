<?php

namespace AppBundle\Controller;

use AppBundle\Form\TweetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Tweet;

/**
 * Class TweetController
 * @package AppBundle\Controller
 */
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
     * @Route("/tweet/new", name="app_tweet_new",methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $tweet = new Tweet();
        $form = $this->createForm(TweetType::class, $tweet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tweet);
            $em->flush();
            $this->addFlash('success','Votre tweet a bien été créé');
            return $this->redirectToRoute('app_tweet_view', ['id' => $tweet->getId()]);
        }
        return $this->render(':tweet:new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view")
     */
    public function tweetAction($id)
    {
        $tweet = $this->getDoctrine()->getRepository(Tweet::class)->getTweet($id);

        if(!$tweet instanceof Tweet)
           throw $this->createNotFoundException(sprintf('Entity Tweet with identifier %d not found', $id));

        return $this->render(':tweet:tweet.html.twig', [
            "tweet" => $tweet,
        ]);
    }


}

