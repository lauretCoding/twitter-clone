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
        $tweets = $this->getManager("app.tweet.manager")->getLast();
        return $this->render(':tweet:list.html.twig', [
            "tweets" => $tweets,
        ]);
    }

    /**
     * @Route("/tweet/new", name="app_tweet_new",methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $tweet = $this->getManager("app.tweet.manager")->create();
        $form = $this->createForm(TweetType::class, $tweet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager("app.tweet.manager")->save($tweet);
            $this->getManager("app.email_messenger")->sendTweetCreated($tweet);
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
        //$translated = $this->get('translator')->trans('app.welcome');
        return $this->render(':tweet:tweet.html.twig', [
            "tweet" => $tweet,
        ]);
    }

    private function getManager($manager){
        return $this->get($manager);
    }
}

