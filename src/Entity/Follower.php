<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FollowerRepository")
 */
class Follower
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $follower;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $followed;


    /**
     * @return mixed
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * @param mixed $follower
     * @return Follower
     */
    public function setFollower($follower)
    {
        $this->follower = $follower;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFollowed()
    {
        return $this->followed;
    }

    /**
     * @param mixed $followed
     * @return Follower
     */
    public function setFollowed($followed)
    {
        $this->followed = $followed;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


}
