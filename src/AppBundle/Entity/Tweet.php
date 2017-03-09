<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Tweet
 *
 * @ORM\Table(name="tweet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TweetRepository")
 */
class Tweet
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
<<<<<<< HEAD
<<<<<<< HEAD
     * @Assert\Length(max="160")
=======
>>>>>>> 904f1787cf2c8a300d1edb38c89dba71a24f09c6
=======
>>>>>>> 904f1787cf2c8a300d1edb38c89dba71a24f09c6
     * @ORM\Column(name="message", type="string", length=160)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank()
     */
    private $createdAt;


    /**
     * Tweet constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Tweet
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Tweet
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

