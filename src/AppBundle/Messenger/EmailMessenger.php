<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 11:49
 */

namespace AppBundle\Messenger;
use AppBundle\Entity\Tweet;


class EmailMessenger
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * EmailMessenger constructor.
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Tweet $tweet
     */
    public function sendTweetCreated(Tweet $tweet){
        $message = \Swift_Message::newInstance()
                ->setSubject('Super subject')
                ->setFrom('send.from@mail.net')
                ->setTo('send.to@mail.net')
                ->setBody('Hello :)');
        $this->send($message);
    }

    /**
     * @param $message
     */
    private function send($message){
        $this->mailer->send($message);
    }
}