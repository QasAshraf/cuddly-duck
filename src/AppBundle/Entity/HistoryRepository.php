<?php

namespace AppBundle\Entity;

/**
 * HistoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HistoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function getReport($user, EventRepository $eventRepo)
    {

        $date = new \DateTime('7 days ago');
        $results = $this->getEntityManager()
            ->createQuery(
                "SELECT h
        FROM AppBundle:History h
        WHERE h.date >= '".$date->format("Y-m-d H:i:s")."'
        AND h.user = '$user'
        ORDER BY h.date DESC")
            ->getResult();
        $events = array();
        foreach($results as $result) {
            $events = array_merge($eventRepo->fineNear($result->getLat(), $result->getLon(), false), $events);
        }
        return $events;
    }
}
