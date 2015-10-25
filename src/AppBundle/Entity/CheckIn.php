<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * CheckIn
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CheckInRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CheckIn  implements JsonSerializable
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="checkIns", fetch="EAGER")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false)
     */
    protected $event;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="checkIns", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set id
     *
     * @param integer $id
     *
     * @return CheckIn
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return CheckIn
     */
    public function setEvent(\AppBundle\Entity\Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return CheckIn
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreated()
    {
        $this->setDate(new \DateTime());
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return History
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function jsonSerialize()
    {
        $result = array(
            'user' => $this->getUser()->jsonSerialize(),
            'date' => $this->date->format('Y-m-d h:i:s')
        );

        return $result;
    }

}
