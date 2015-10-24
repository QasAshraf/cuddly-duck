<?php

namespace AppBundle\Services;

use Codebird\Codebird;

/**
 * Service to handle twitter post
 *
 */
class TwitterService
{
    /**
     * Service container
     *
     * @var container
     */
    protected $container;

    /**
     * construct
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function postTweet($status)
    {

        Codebird::setConsumerKey(
            $this->container->getParameter('hm_twitterApiKey'),
            $this->container->getParameter('hm_twitterApiSecret'));

        $cb = Codebird::getInstance();

        $cb->setToken(
            $this->container->getParameter('hm_twitterApiToken'),
            $this->container->getParameter('hm_twitterApiTokenSecret'));

        $reply = $cb->statuses_update('status=' . $status);

        return $reply;
    }
}