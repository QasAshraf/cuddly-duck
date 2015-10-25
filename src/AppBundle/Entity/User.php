<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 */
class User implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return User
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /** @ORM\OneToMany(targetEntity="AppBundle\Entity\CheckIn", mappedBy="user", fetch="EAGER") */
    protected $checkIns;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->checkIns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add checkIn
     *
     * @param \AppBundle\Entity\CheckIn $checkIn
     *
     * @return User
     */
    public function addCheckIn(\AppBundle\Entity\CheckIn $checkIn)
    {
        $this->checkIns[] = $checkIn;

        return $this;
    }

    /**
     * Remove checkIn
     *
     * @param \AppBundle\Entity\CheckIn $checkIn
     */
    public function removeCheckIn(\AppBundle\Entity\CheckIn $checkIn)
    {
        $this->checkIns->removeElement($checkIn);
    }

    /**
     * Get checkIns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCheckIns()
    {
        return $this->checkIns;
    }

    public function jsonSerialize()
    {
        $result = array(
            'user' => $this->getUser(),
            'username' => $this->getUsername()
        );

        return $result;
    }

}
