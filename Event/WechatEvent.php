<?php

namespace MauticPlugin\WechatBundle\Event;

use Mautic\CoreBundle\Event\CommonEvent;
use MauticPlugin\WechatBundle\Entity\Account;
use MauticPlugin\WechatBundle\Entity\Stat;

/**
 * Class WechatEvent
 *
 * @package MauticPlugin\WechatBundle\Event
 */
class WechatEvent extends CommonEvent
{
    private $request;
    private $stat;

    /**
     * @param Email $email
     */
    public function __construct(Stat $stat, $request)
    {
        $this->entity  = $stat;
        $this->request = $request;
    }

    /**
     * Get email request
     *
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Stat
     */
    public function getStat()
    {
        return $this->entity;
    }

    /**
     * @return eventType
     */
    public function getEventType()
    {
        return $this->entity->getEventType();
    }
}
