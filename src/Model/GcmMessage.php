<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Model;

/**
 * Message
 * Definition of message for push notification
 * Refere to GCM documentation for more details: https://developers.google.com/cloud-messaging/http-server-ref.
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
    protected $collapse_key;

    /**
     * @var string
     */
    protected $priority;

    /**
     * @var bool
     */
    protected $content_available;

    /**
     * @var bool
     */
    protected $delay_while_idle;

    /**
     * @var int
     */
    protected $time_to_live;

    /**
     * @var string
     */
    protected $restricted_package_name;

    /**
     * @var bool
     */
    protected $dry_run;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $notification_title;

    /**
     * @var string
     */
    protected $notification_body;

    /**
     * @var string
     */
    protected $notification_icon;

    /**
     * @var string
     */
    protected $notification_sound;

    /**
     * @var string
     */
    protected $notification_badge;

    /**
     * @var string
     */
    protected $notification_tag;

    /**
     * @var string
     */
    protected $notification_color;

    /**
     * @var string
     */
    protected $notification_click_action;

    /**
     * @var string
     */
    protected $notification_body_loc_key;

    /**
     * @var array
     */
    protected $notification_body_loc_args;

    /**
     * @var string
     */
    protected $notification_title_loc_key;

    /**
     * @var array
     */
    protected $notification_title_loc_args;

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
     * Set the value of The devices token.
     *
     * @param array tokens
     *
     * @return self
     */
    public function setTokens(array $tokens)
    {
        if (count($tokens) > self::MULTICAST_MAX_TOKENS) {
            throw new \RuntimeException('The key "asp" is reserved. Do not use it for data.');
        }

        $this->tokens = $tokens;

        return $this;
    }

    /**
     * Add the value of The devices token.
     *
     * @param string token
     *
     * @return self
     */
    public function addToken($token)
    {
        $tokens = $this->getTokens();

        $tokens[] = $token;

        return $this->setTokens($tokens);
    }

    /**
     * Get the value of Collapse Key.
     *
     * @return string
     */
    public function getCollapseKey()
    {
        return $this->collapse_key;
    }

    /**
     * Set the value of Collapse Key.
     *
     * @param string collapse_key
     *
     * @return self
     */
    public function setCollapseKey($collapse_key)
    {
        $this->collapse_key = $collapse_key;

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
     * @param string priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        if (!in_array($priority, array('normal', 'high'))) {
            throw new \RuntimeException('Bad value. Allowed priority value are "normal" or "high"');
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
        return $this->content_available;
    }

    /**
     * Set the value of Content Available.
     *
     * @param bool content_available
     *
     * @return self
     */
    public function setContentAvailable($content_available)
    {
        $this->content_available = $content_available;

        return $this;
    }

    /**
     * Get the value of Delay While Idle.
     *
     * @return bool
     */
    public function getDelayWhileIdle()
    {
        return $this->delay_while_idle;
    }

    /**
     * Set the value of Delay While Idle.
     *
     * @param bool delay_while_idle
     *
     * @return self
     */
    public function setDelayWhileIdle($delay_while_idle)
    {
        $this->delay_while_idle = $delay_while_idle;

        return $this;
    }

    /**
     * Get the value of Time To Live.
     *
     * @return int
     */
    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    /**
     * Set the value of Time To Live.
     *
     * @param int time_to_live
     *
     * @return self
     */
    public function setTimeToLive($time_to_live)
    {
        $this->time_to_live = $time_to_live;

        return $this;
    }

    /**
     * Get the value of Restricted Package Name.
     *
     * @return string
     */
    public function getRestrictedPackageName()
    {
        return $this->restricted_package_name;
    }

    /**
     * Set the value of Restricted Package Name.
     *
     * @param string restricted_package_name
     *
     * @return self
     */
    public function setRestrictedPackageName($restricted_package_name)
    {
        $this->restricted_package_name = $restricted_package_name;

        return $this;
    }

    /**
     * Get the value of Dry Run.
     *
     * @return bool
     */
    public function getDryRun()
    {
        return $this->dry_run;
    }

    /**
     * Set the value of Dry Run.
     *
     * @param bool dry_run
     *
     * @return self
     */
    public function setDryRun($dry_run)
    {
        $this->dry_run = $dry_run;

        return $this;
    }

    /**
     * Get the value of Data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of Data.
     *
     * @param array data
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
        return $this->notification_title;
    }

    /**
     * Set the value of Notification Title.
     *
     * @param string notification_title
     *
     * @return self
     */
    public function setNotificationTitle($notification_title)
    {
        $this->notification_title = $notification_title;

        return $this;
    }

    /**
     * Get the value of Notification Body.
     *
     * @return string
     */
    public function getNotificationBody()
    {
        return $this->notification_body;
    }

    /**
     * Set the value of Notification Body.
     *
     * @param string notification_body
     *
     * @return self
     */
    public function setNotificationBody($notification_body)
    {
        $this->notification_body = $notification_body;

        return $this;
    }

    /**
     * Get the value of Notification Icon.
     *
     * @return string
     */
    public function getNotificationIcon()
    {
        return $this->notification_icon;
    }

    /**
     * Set the value of Notification Icon.
     *
     * @param string notification_icon
     *
     * @return self
     */
    public function setNotificationIcon($notification_icon)
    {
        $this->notification_icon = $notification_icon;

        return $this;
    }

    /**
     * Get the value of Notification Sound.
     *
     * @return string
     */
    public function getNotificationSound()
    {
        return $this->notification_sound;
    }

    /**
     * Set the value of Notification Sound.
     *
     * @param string notification_sound
     *
     * @return self
     */
    public function setNotificationSound($notification_sound)
    {
        $this->notification_sound = $notification_sound;

        return $this;
    }

    /**
     * Get the value of Notification Badge.
     *
     * @return string
     */
    public function getNotificationBadge()
    {
        return $this->notification_badge;
    }

    /**
     * Set the value of Notification Badge.
     *
     * @param string notification_badge
     *
     * @return self
     */
    public function setNotificationBadge($notification_badge)
    {
        $this->notification_badge = $notification_badge;

        return $this;
    }

    /**
     * Get the value of Notification Tag.
     *
     * @return string
     */
    public function getNotificationTag()
    {
        return $this->notification_tag;
    }

    /**
     * Set the value of Notification Tag.
     *
     * @param string notification_tag
     *
     * @return self
     */
    public function setNotificationTag($notification_tag)
    {
        $this->notification_tag = $notification_tag;

        return $this;
    }

    /**
     * Get the value of Notification Color.
     *
     * @return string
     */
    public function getNotificationColor()
    {
        return $this->notification_color;
    }

    /**
     * Set the value of Notification Color.
     *
     * @param string notification_color
     *
     * @return self
     */
    public function setNotificationColor($notification_color)
    {
        $this->notification_color = $notification_color;

        return $this;
    }

    /**
     * Get the value of Notification Click Action.
     *
     * @return string
     */
    public function getNotificationClickAction()
    {
        return $this->notification_click_action;
    }

    /**
     * Set the value of Notification Click Action.
     *
     * @param string notification_click_action
     *
     * @return self
     */
    public function setNotificationClickAction($notification_click_action)
    {
        $this->notification_click_action = $notification_click_action;

        return $this;
    }

    /**
     * Get the value of Notification Body Loc Key.
     *
     * @return string
     */
    public function getNotificationBodyLocKey()
    {
        return $this->notification_body_loc_key;
    }

    /**
     * Set the value of Notification Body Loc Key.
     *
     * @param string notification_body_loc_key
     *
     * @return self
     */
    public function setNotificationBodyLocKey($notification_body_loc_key)
    {
        $this->notification_body_loc_key = $notification_body_loc_key;

        return $this;
    }

    /**
     * Get the value of Notification Body Loc Args.
     *
     * @return array
     */
    public function getNotificationBodyLocArgs()
    {
        return $this->notification_body_loc_args;
    }

    /**
     * Set the value of Notification Body Loc Args.
     *
     * @param array notification_body_loc_args
     *
     * @return self
     */
    public function setNotificationBodyLocArgs(array $notification_body_loc_args)
    {
        $this->notification_body_loc_args = $notification_body_loc_args;

        return $this;
    }

    /**
     * Get the value of Notification Title Loc Key.
     *
     * @return string
     */
    public function getNotificationTitleLocKey()
    {
        return $this->notification_title_loc_key;
    }

    /**
     * Set the value of Notification Title Loc Key.
     *
     * @param string notification_title_loc_key
     *
     * @return self
     */
    public function setNotificationTitleLocKey($notification_title_loc_key)
    {
        $this->notification_title_loc_key = $notification_title_loc_key;

        return $this;
    }

    /**
     * Get the value of Notification Title Loc Args.
     *
     * @return array
     */
    public function getNotificationTitleLocArgs()
    {
        return $this->notification_title_loc_args;
    }

    /**
     * Set the value of Notification Title Loc Args.
     *
     * @param array notification_title_loc_args
     *
     * @return self
     */
    public function setNotificationTitleLocArgs(array $notification_title_loc_args)
    {
        $this->notification_title_loc_args = $notification_title_loc_args;

        return $this;
    }
}
