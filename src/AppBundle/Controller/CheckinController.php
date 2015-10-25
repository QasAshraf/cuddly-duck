<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CheckIn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Checkin controller.
 *
 * @Route("/checkin")
 */
class CheckinController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CheckIn')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * @Route("/")
     * @Method("POST")
     * @param Request $request
     * @return array
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $checkinData = json_decode($request->getContent(), true);
        $checkin = new CheckIn();

        $event = $em->getRepository('AppBundle:Event')->findOneBy(array('id' => $checkinData['event_id']));
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('username' => $checkinData['username']));
        $checkin->setEvent($event);
        $checkin->setUser($user);

        $em->persist($checkin);
        $em->flush();
        return new JsonResponse(null, 201);
    }

}
