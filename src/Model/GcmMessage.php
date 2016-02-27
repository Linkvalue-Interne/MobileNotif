<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Model;

/**
 * Google Cloud Messaging Message implementation.
 * Refer to GCM documentation for more details: https://developers.google.com/cloud-messaging/http-server-ref.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class GcmMessage extends Message
{
    const MULTICAST_MAX_TOKENS = 1000;

    /**
     * @var string
     */
    private $collapseKey;

    /**
     * @var string
     */
    private $priority;

    /**
     * @var bool
     */
    private $contentAvailable;

    /**
     * @var bool
     */
    private $delayWhileIdle;

    /**
     * @var int
     */
    private $timeToLive;

    /**
     * @var string
     */
    private $restrictedPackageName;

    /**
     * @var bool
     */
    private $dryRun;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $notificationTitle;

    /**
     * @var string
     */
    private $notificationBody;

    /**
     * @var string
     */
    private $notificationIcon;

    /**
     * @var string
     */
    private $notificationSound;

    /**
     * @var string
     */
    private $notificationBadge;

    /**
     * @var string
     */
    private $notificationTag;

    /**
     * @var string
     */
    private $notificationColor;

    /**
     * @var string
     */
    private $notificationClickAction;

    /**
     * @var string
     */
    private $notificationTitleLocKey;

    /**
     * @var array
     */
    private $notificationTitleLocArgs;

    /**
     * @var string
     */
    private $notificationBodyLocKey;

    /**
     * @var array
     */
    private $notificationBodyLocArgs;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->notificationBodyLocArgs = array();
        $this->notificationTitleLocArgs = array();
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return array(
            'registration_ids' => $this->getTokens(),
            'collapse_key' => $this->getCollapseKey(),
            'priority' => $this->getPriority(),
            'content_available' => $this->getContentAvailable(),
            'delay_while_idle' => $this->getDelayWhileIdle(),
            'time_to_live' => $this->getTimeToLive(),
            'restricted_package_name' => $this->getRestrictedPackageName(),
            'dry_run' => $this->getDryRun(),
            'data' => $this->getData(),
            'notification' => array(
                'title' => $this->getNotificationTitle(),
                'body' => $this->getNotificationBody(),
                'icon' => $this->getNotificationIcon(),
                'sound' => $this->getNotificationSound(),
                'badge' => $this->getNotificationBadge(),
                'tag' => $this->getNotificationTag(),
                'color' => $this->getNotificationColor(),
                'click_action' => $this->getNotificationClickAction(),
                'body_loc_key' => $this->getNotificationBodyLocKey(),
                'body_loc_args' => $this->getNotificationBodyLocArgs(),
                'title_loc_key' => $this->getNotificationTitleLocKey(),
                'title_loc_args' => $this->getNotificationTitleLocArgs(),
            ),
        );
    }

    /**
     * {@inheritdoc }
     *
     * @throws \RuntimeException
     */
    public function setTokens(array $tokens)
    {
        if (count($tokens) > self::MULTICAST_MAX_TOKENS) {
            throw new \RuntimeException(sprintf('Too many tokens in the list. %s tokens max.', self::MULTICAST_MAX_TOKENS));
        }

        return parent::setTokens($tokens);
    }

    /**
     * {@inheritdoc }
     *
     * @throws \RuntimeException
     */
    public function addToken($token)
    {
        if (count($this->tokens) + 1 > self::MULTICAST_MAX_TOKENS) {
            throw new \RuntimeException(sprintf('Max token number reached. %s tokens max.', self::MULTICAST_MAX_TOKENS));
        }

        return parent::addToken($token);
    }

    /**
     * Get the value of Collapse Key.
     *
     * @return string
     */
    public function getCollapseKey()
    {
        return $this->collapseKey;
    }

    /**
     * Set the value of Collapse Key.
     *
     * @param string $collapseKey
     *
     * @return self
     */
    public function setCollapseKey($collapseKey)
    {
        $this->collapseKey = $collapseKey;

        return $this;
    }

    /**
     * Get the value of Priority.
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority ? $this->priority : 'normal';
    }

    /**
     * Set the value of Priority.
     *
     * @param string $priority 'normal'|'hight'
     *
     * @return self
     */
    public function setPriority($priority)
    {
        if (!in_array($priority, array('normal', 'high'))) {
            throw new \RuntimeException('Bad value. Allowed priority values are "normal" or "high"');
        }

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get the value of Content Available.
     *
     * @return bool
     */
    public function getContentAvailable()
    {
        return !empty($this->contentAvailable);
    }

    /**
     * Set the value of Content Available.
     *
     * @param bool $contentAvailable
     *
     * @return self
     */
    public function setContentAvailable($contentAvailable)
    {
        $this->contentAvailable = !empty($contentAvailable);

        return $this;
    }

    /**
     * Get the value of Delay While Idle.
     *
     * @return bool
     */
    public function getDelayWhileIdle()
    {
        return !empty($this->delayWhileIdle);
    }

    /**
     * Set the value of Delay While Idle.
     *
     * @param bool $delayWhileIdle
     *
     * @return self
     */
    public function setDelayWhileIdle($delayWhileIdle)
    {
        $this->delayWhileIdle = !empty($delayWhileIdle);

        return $this;
    }

    /**
     * Get the value of Time To Live.
     *
     * @return int
     */
    public function getTimeToLive()
    {
        return (int) $this->timeToLive;
    }

    /**
     * Set the value of Time To Live.
     *
     * @param int $timeToLive
     *
     * @return self
     */
    public function setTimeToLive($timeToLive)
    {
        $this->timeToLive = (int) $timeToLive;

        return $this;
    }

    /**
     * Get the value of Restricted Package Name.
     *
     * @return string
     */
    public function getRestrictedPackageName()
    {
        return $this->restrictedPackageName;
    }

    /**
     * Set the value of Restricted Package Name.
     *
     * @param string $restrictedPackageName
     *
     * @return self
     */
    public function setRestrictedPackageName($restrictedPackageName)
    {
        $this->restrictedPackageName = $restrictedPackageName;

        return $this;
    }

    /**
     * Get the value of Dry Run.
     *
     * @return bool
     */
    public function getDryRun()
    {
        return !empty($this->dryRun);
    }

    /**
     * Set the value of Dry Run.
     *
     * @param bool $dryRun
     *
     * @return self
     */
    public function setDryRun($dryRun)
    {
        $this->dryRun = !empty($dryRun);

        return $this;
    }

    /**
     * Get the value of Data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data ? $this->data : array();
    }

    /**
     * Set the value of Data.
     *
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of Notification Title.
     *
     * @return string
     */
    public function getNotificationTitle()
    {
        return $this->notificationTitle;
    }

    /**
     * Set the value of Notification Title.
     *
     * @param string $notificationTitle
     *
     * @return self
     */
    public function setNotificationTitle($notificationTitle)
    {
        $this->notificationTitle = $notificationTitle;

        return $this;
    }

    /**
     * Get the value of Notification Body.
     *
     * @return string
     */
    public function getNotificationBody()
    {
        return $this->notificationBody;
    }

    /**
     * Set the value of Notification Body.
     *
     * @param string $notificationBody
     *
     * @return self
     */
    public function setNotificationBody($notificationBody)
    {
        $this->notificationBody = $notificationBody;

        return $this;
    }

    /**
     * Get the value of Notification Icon.
     *
     * @return string
     */
    public function getNotificationIcon()
    {
        return $this->notificationIcon;
    }

    /**
     * Set the value of Notification Icon.
     *
     * @param string $notificationIcon
     *
     * @return self
     */
    public function setNotificationIcon($notificationIcon)
    {
        $this->notificationIcon = $notificationIcon;

        return $this;
    }

    /**
     * Get the value of Notification Sound.
     *
     * @return string
     */
    public function getNotificationSound()
    {
        return $this->notificationSound;
    }

    /**
     * Set the value of Notification Sound.
     *
     * @param string $notificationSound
     *
     * @return self
     */
    public function setNotificationSound($notificationSound)
    {
        $this->notificationSound = $notificationSound;

        return $this;
    }

    /**
     * Get the value of Notification Badge.
     *
     * @return string
     */
    public function getNotificationBadge()
    {
        return $this->notificationBadge;
    }

    /**
     * Set the value of Notification Badge.
     *
     * @param string $notificationBadge
     *
     * @return self
     */
    public function setNotificationBadge($notificationBadge)
    {
        $this->notificationBadge = $notificationBadge;

        return $this;
    }

    /**
     * Get the value of Notification Tag.
     *
     * @return string
     */
    public function getNotificationTag()
    {
        return $this->notificationTag;
    }

    /**
     * Set the value of Notification Tag.
     *
     * @param string $notificationTag
     *
     * @return self
     */
    public function setNotificationTag($notificationTag)
    {
        $this->notificationTag = $notificationTag;

        return $this;
    }

    /**
     * Get the value of Notification Color.
     *
     * @return string
     */
    public function getNotificationColor()
    {
        return $this->notificationColor;
    }

    /**
     * Set the value of Notification Color.
     *
     * @param string $notificationColor
     *
     * @return self
     */
    public function setNotificationColor($notificationColor)
    {
        $this->notificationColor = $notificationColor;

        return $this;
    }

    /**
     * Get the value of Notification Click Action.
     *
     * @return string
     */
    public function getNotificationClickAction()
    {
        return $this->notificationClickAction;
    }

    /**
     * Set the value of Notification Click Action.
     *
     * @param string $notificationClickAction
     *
     * @return self
     */
    public function setNotificationClickAction($notificationClickAction)
    {
        $this->notificationClickAction = $notificationClickAction;

        return $this;
    }

    /**
     * Get the value of Notification Body Loc Key.
     *
     * @return string
     */
    public function getNotificationBodyLocKey()
    {
        return $this->notificationBodyLocKey;
    }

    /**
     * Set the value of Notification Body Loc Key.
     *
     * @param string $notificationBodyLocKey
     *
     * @return self
     */
    public function setNotificationBodyLocKey($notificationBodyLocKey)
    {
        $this->notificationBodyLocKey = $notificationBodyLocKey;

        return $this;
    }

    /**
     * Get the value of Notification Body Loc Args.
     *
     * @return array
     */
    public function getNotificationBodyLocArgs()
    {
        return $this->notificationBodyLocArgs;
    }

    /**
     * Set the value of Notification Body Loc Args.
     *
     * @param array $notificationBodyLocArgs
     *
     * @return self
     */
    public function setNotificationBodyLocArgs(array $notificationBodyLocArgs)
    {
        $this->notificationBodyLocArgs = $notificationBodyLocArgs;

        return $this;
    }

    /**
     * Get the value of Notification Title Loc Key.
     *
     * @return string
     */
    public function getNotificationTitleLocKey()
    {
        return $this->notificationTitleLocKey;
    }

    /**
     * Set the value of Notification Title Loc Key.
     *
     * @param string $notificationTitleLocKey
     *
     * @return self
     */
    public function setNotificationTitleLocKey($notificationTitleLocKey)
    {
        $this->notificationTitleLocKey = $notificationTitleLocKey;

        return $this;
    }

    /**
     * Get the value of Notification Title Loc Args.
     *
     * @return array
     */
    public function getNotificationTitleLocArgs()
    {
        return $this->notificationTitleLocArgs;
    }

    /**
     * Set the value of Notification Title Loc Args.
     *
     * @param array $notificationTitleLocArgs
     *
     * @return self
     */
    public function setNotificationTitleLocArgs(array $notificationTitleLocArgs)
    {
        $this->notificationTitleLocArgs = $notificationTitleLocArgs;

        return $this;
    }
}
