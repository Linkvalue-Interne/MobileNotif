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
 * Refere to APNS documentation for more details: https://developer.apple.com/library/ios/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/Chapters/ApplePushService.html#//apple_ref/doc/uid/TP40008194-CH100-SW9.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class AppleMessage extends Message
{
    /**
     * @var string
     */
    protected $alert_title;

    /**
     * @var string
     */
    protected $alert_body;

    /**
     * @var string
     */
    protected $alert_title_loc_key;

    /**
     * @var array
     */
    protected $alert_title_loc_args;

    /**
     * @var string
     */
    protected $alert_action_loc_key;

    /**
     * @var string
     */
    protected $alert_loc_key;

    /**
     * @var array
     */
    protected $alert_loc_args;

    /**
     * @var string
     */
    protected $alert_launch_image;

    /**
     * @var string
     */
    protected $badge;

    /**
     * @var string
     */
    protected $sound;

    /**
     * @var int
     */
    protected $content_available;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->alert_title_loc_args = array();
        $this->alert_loc_args = array();
        $this->data = array();
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        $payload = array(
            'aps' => array(
                'alert' => array(
                    'title' => $this->getAlertTitle(),
                    'body' => $this->getAlertBody(),
                    'title-loc-key' => $this->getAlertTitleLocKey(),
                    'title-loc-args' => $this->getAlertTitleLocArgs(),
                    'action-loc-key' => $this->getAlertActionLocKey(),
                    'loc-key' => $this->getAlertLocKey(),
                    'loc-args' => $this->getAlertLocArgs(),
                    'launch-image' => $this->getAlertLaunchImage(),
                ),
                'badge' => $this->getBadge(),
                'sound' => $this->getSound(),
                'content-available' => $this->getContentAvailable(),
                'category' => $this->getCategory(),
            ),
        );

        return array_merge($payload, $this->getData());
    }

    /**
     * Get the value of Alert Title.
     *
     * @return string
     */
    public function getAlertTitle()
    {
        return $this->alert_title;
    }

    /**
     * Set the value of Alert Title.
     *
     * @param string alert_title
     *
     * @return self
     */
    public function setAlertTitle($alert_title)
    {
        $this->alert_title = $alert_title;

        return $this;
    }

    /**
     * Get the value of Alert Body.
     *
     * @return string
     */
    public function getAlertBody()
    {
        return $this->alert_body;
    }

    /**
     * Set the value of Alert Body.
     *
     * @param string alert_body
     *
     * @return self
     */
    public function setAlertBody($alert_body)
    {
        $this->alert_body = $alert_body;

        return $this;
    }

    /**
     * Get the value of Alert Title Loc Key.
     *
     * @return string
     */
    public function getAlertTitleLocKey()
    {
        return $this->alert_title_loc_key;
    }

    /**
     * Set the value of Alert Title Loc Key.
     *
     * @param string alert_title_loc_key
     *
     * @return self
     */
    public function setAlertTitleLocKey($alert_title_loc_key)
    {
        $this->alert_title_loc_key = $alert_title_loc_key;

        return $this;
    }

    /**
     * Get the value of Alert Title Loc Args.
     *
     * @return array
     */
    public function getAlertTitleLocArgs()
    {
        return $this->alert_title_loc_args;
    }

    /**
     * Set the value of Alert Title Loc Args.
     *
     * @param array alert_title_loc_args
     *
     * @return self
     */
    public function setAlertTitleLocArgs(array $alert_title_loc_args)
    {
        $this->alert_title_loc_args = $alert_title_loc_args;

        return $this;
    }

    /**
     * Get the value of Alert Action Loc Key.
     *
     * @return string
     */
    public function getAlertActionLocKey()
    {
        return $this->alert_action_loc_key;
    }

    /**
     * Set the value of Alert Action Loc Key.
     *
     * @param string alert_action_loc_key
     *
     * @return self
     */
    public function setAlertActionLocKey($alert_action_loc_key)
    {
        $this->alert_action_loc_key = $alert_action_loc_key;

        return $this;
    }

    /**
     * Get the value of Alert Loc Key.
     *
     * @return string
     */
    public function getAlertLocKey()
    {
        return $this->alert_loc_key;
    }

    /**
     * Set the value of Alert Loc Key.
     *
     * @param string alert_loc_key
     *
     * @return self
     */
    public function setAlertLocKey($alert_loc_key)
    {
        $this->alert_loc_key = $alert_loc_key;

        return $this;
    }

    /**
     * Get the value of Alert Loc Args.
     *
     * @return array
     */
    public function getAlertLocArgs()
    {
        return $this->alert_loc_args;
    }

    /**
     * Set the value of Alert Loc Args.
     *
     * @param array alert_loc_args
     *
     * @return self
     */
    public function setAlertLocArgs(array $alert_loc_args)
    {
        $this->alert_loc_args = $alert_loc_args;

        return $this;
    }

    /**
     * Get the value of Alert Launch Image.
     *
     * @return string
     */
    public function getAlertLaunchImage()
    {
        return $this->alert_launch_image;
    }

    /**
     * Set the value of Alert Launch Image.
     *
     * @param string alert_launch_image
     *
     * @return self
     */
    public function setAlertLaunchImage($alert_launch_image)
    {
        $this->alert_launch_image = $alert_launch_image;

        return $this;
    }

    /**
     * Get the value of Badge.
     *
     * @return string
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set the value of Badge.
     *
     * @param string badge
     *
     * @return self
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Get the value of Sound.
     *
     * @return string
     */
    public function getSound()
    {
        return $this->sound ? $this->sound : 'default';
    }

    /**
     * Set the value of Sound.
     *
     * @param string sound
     *
     * @return self
     */
    public function setSound($sound)
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * Get the value of Content Available.
     *
     * @return int
     */
    public function getContentAvailable()
    {
        return $this->content_available;
    }

    /**
     * Set the value of Content Available.
     *
     * @param int content_available
     *
     * @return self
     */
    public function setContentAvailable($content_available)
    {
        $this->content_available = $content_available;

        return $this;
    }

    /**
     * Get the value of Category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of Category.
     *
     * @param string category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the data array.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data array.
     *
     * @param array data
     *
     * @return self
     */
    public function setData(array $data)
    {
        if (isset($data['aps'])) {
            throw new \RuntimeException('The key "asp" is reserved. Do not use it for data.');
        }

        $this->data = $data;

        return $this;
    }

    /**
     * Add a value at a specific key to the data array.
     *
     * @param string $key
     * @param string $value
     *
     * @return self
     */
    public function addData($key, $value)
    {
        $data = $this->getData();

        $data[$key] = $value;

        //use setData to validate the new array before added it
        return $this->setData($data);
    }
}
