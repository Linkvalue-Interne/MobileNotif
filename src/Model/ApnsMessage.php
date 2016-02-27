<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Model;

/**
 * Apple Push Notification Service Message implementation.
 *
 * Refer to APNS documentation for more details: https://developer.apple.com/library/ios/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/Chapters/ApplePushService.html#//apple_ref/doc/uid/TP40008194-CH100-SW9.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class ApnsMessage extends Message
{
    /**
     * @var string
     */
    private $alertTitle;

    /**
     * @var string
     */
    private $alertBody;

    /**
     * @var string
     */
    private $alertTitleLocKey;

    /**
     * @var array
     */
    private $alertTitleLocArgs;

    /**
     * @var string
     */
    private $alertActionLocKey;

    /**
     * @var string
     */
    private $alertLocKey;

    /**
     * @var array
     */
    private $alertLocArgs;

    /**
     * @var string
     */
    private $alertLaunchImage;

    /**
     * @var string
     */
    private $badge;

    /**
     * @var string
     */
    private $sound;

    /**
     * @var int
     */
    private $contentAvailable;

    /**
     * @var string
     */
    private $category;

    /**
     * @var array
     */
    private $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->alertTitleLocArgs = array();
        $this->alertLocArgs = array();
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
        return $this->alertTitle;
    }

    /**
     * Set the value of Alert Title.
     *
     * @param string $alertTitle
     *
     * @return self
     */
    public function setAlertTitle($alertTitle)
    {
        $this->alertTitle = $alertTitle;

        return $this;
    }

    /**
     * Get the value of Alert Body.
     *
     * @return string
     */
    public function getAlertBody()
    {
        return $this->alertBody;
    }

    /**
     * Set the value of Alert Body.
     *
     * @param string $alertBody
     *
     * @return self
     */
    public function setAlertBody($alertBody)
    {
        $this->alertBody = $alertBody;

        return $this;
    }

    /**
     * Get the value of Alert Title Loc Key.
     *
     * @return string
     */
    public function getAlertTitleLocKey()
    {
        return $this->alertTitleLocKey;
    }

    /**
     * Set the value of Alert Title Loc Key.
     *
     * @param string $alertTitleLocKey
     *
     * @return self
     */
    public function setAlertTitleLocKey($alertTitleLocKey)
    {
        $this->alertTitleLocKey = $alertTitleLocKey;

        return $this;
    }

    /**
     * Get the value of Alert Title Loc Args.
     *
     * @return array
     */
    public function getAlertTitleLocArgs()
    {
        return $this->alertTitleLocArgs;
    }

    /**
     * Set the value of Alert Title Loc Args.
     *
     * @param array $alertTitleLocArgs
     *
     * @return self
     */
    public function setAlertTitleLocArgs(array $alertTitleLocArgs)
    {
        $this->alertTitleLocArgs = $alertTitleLocArgs;

        return $this;
    }

    /**
     * Get the value of Alert Action Loc Key.
     *
     * @return string
     */
    public function getAlertActionLocKey()
    {
        return $this->alertActionLocKey;
    }

    /**
     * Set the value of Alert Action Loc Key.
     *
     * @param string $alertActionLocKey
     *
     * @return self
     */
    public function setAlertActionLocKey($alertActionLocKey)
    {
        $this->alertActionLocKey = $alertActionLocKey;

        return $this;
    }

    /**
     * Get the value of Alert Loc Key.
     *
     * @return string
     */
    public function getAlertLocKey()
    {
        return $this->alertLocKey;
    }

    /**
     * Set the value of Alert Loc Key.
     *
     * @param string $alertLocKey
     *
     * @return self
     */
    public function setAlertLocKey($alertLocKey)
    {
        $this->alertLocKey = $alertLocKey;

        return $this;
    }

    /**
     * Get the value of Alert Loc Args.
     *
     * @return array
     */
    public function getAlertLocArgs()
    {
        return $this->alertLocArgs;
    }

    /**
     * Set the value of Alert Loc Args.
     *
     * @param array $alertLocArgs
     *
     * @return self
     */
    public function setAlertLocArgs(array $alertLocArgs)
    {
        $this->alertLocArgs = $alertLocArgs;

        return $this;
    }

    /**
     * Get the value of Alert Launch Image.
     *
     * @return string
     */
    public function getAlertLaunchImage()
    {
        return $this->alertLaunchImage;
    }

    /**
     * Set the value of Alert Launch Image.
     *
     * @param string $alertLaunchImage
     *
     * @return self
     */
    public function setAlertLaunchImage($alertLaunchImage)
    {
        $this->alertLaunchImage = $alertLaunchImage;

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
     * @param string $badge
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
     * @param string $sound
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
        return $this->contentAvailable;
    }

    /**
     * Set the value of Content Available.
     *
     * @param int $contentAvailable
     *
     * @return self
     */
    public function setContentAvailable($contentAvailable)
    {
        $this->contentAvailable = $contentAvailable;

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
     * @param string $category
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
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data)
    {
        if (isset($data['aps'])) {
            throw new \RuntimeException('The key "aps" is reserved. Do not use it for data.');
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

        return $this->setData($data);
    }
}
