<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EventRepository")
 */
class Event implements JsonSerializable
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="Lat", type="float")
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="Lon", type="float")
     */
    private $long;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=1000)
     */
    private $description;

    /**
     * @var float
     *
     */
    private $distance;

    public function jsonSerialize()
    {
        if (is_null($this->distance)) {

            return array(
                'id' => $this->id,
                'name' => $this->name,
                'location' => array(
                    'lat' => $this->lat,
                    'lon' => $this->long,
                ),
                'description' => $this->description,
                'date' => $this->date->format('Y-m-d h:i:s')

            );

        } else {
            return array(
                'id' => $this->id,
                'name' => $this->name,
                'location' => array(
                    'latitude' => $this->lat,
                    'longitude' => $this->long,
                ),
                'description' => $this->description,
                'date' => $this->date->format('Y-m-d h:i:s'),
                'distance' => $this->distance

            );
        }
    }


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
     * @return float
     */
    public function getDistance()
    {
        if (isset($this->_values['distance']))
        {
            $this->distance = $this->_values['nb_tags'];
        }
        return $this->distance;
    }

    /**
     * @param float $distance
     * @return float
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
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
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Event
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set long
     *
     * @param string $long
     *
     * @return Event
     */
    public function setLon($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long
     *
     * @return string
     */
    public function getLon()
    {
        return $this->long;
    }
}
