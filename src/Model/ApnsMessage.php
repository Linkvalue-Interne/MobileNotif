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
 * Refer to APNS documentation for more details.
 *
 * @see https://developer.apple.com/library/ios/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/Chapters/TheNotificationPayload.html
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class ApnsMessage extends Message
{
    // Default values
    const DEFAULT_SOUND = 'default';

    /**
     * @var string
     */
    private $simpleAlert;

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
     * @var int
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
     * @var array
     */
    private $action;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->sound = self::DEFAULT_SOUND;
        $this->alertTitleLocArgs = array();
        $this->alertLocArgs = array();
        $this->data = array();
    }

    /**
     * Get full message payload.
     *
     * @return array
     */
    public function getPayload()
    {
        // APNS base payload structure
        $payload = array(
            'aps' => array(),
        );

        // Build notification
        if ($this->getPayloadAlertKeyValue()) {
            $payload['aps']['alert'] = $this->getPayloadAlertKeyValue();
        }

        // Build extra content
        if (!is_null($this->getBadge())) {
            $payload['aps']['badge'] = $this->getBadge();
        }
        if ($this->getSound() !== self::DEFAULT_SOUND) {
            $payload['aps']['sound'] = $this->getSound();
        }
        if (!is_null($this->getContentAvailable())) {
            $payload['aps']['content-available'] = $this->getContentAvailable();
        }
        if ($this->getCategory()) {
            $payload['aps']['category'] = $this->getCategory();
        }
        if ($this->getData()) {
            $payload['data'] = $this->getData();
        }

        // Return payload
        return $payload;
    }

    /**
     * Get the value of Simple Alert.
     *
     * @return string
     */
    public function getSimpleAlert()
    {
        return $this->simpleAlert;
    }

    /**
     * Set the value of Simple Alert.
     *
     * @param string $simpleAlert
     *
     * @return self
     */
    public function setSimpleAlert($simpleAlert)
    {
        if (!is_string($simpleAlert)) {
            throw new \InvalidArgumentException('Simple Alert must be set with a value of type "string".');
        }

        $this->simpleAlert = $simpleAlert;

        return $this;
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
     * @return int
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set the value of Badge.
     *
     * @param int $badge
     *
     * @return self
     */
    public function setBadge($badge)
    {
        $this->badge = (int) $badge;

        return $this;
    }

    /**
     * Get the value of Sound.
     *
     * @return string
     */
    public function getSound()
    {
        return $this->sound;
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
        $this->contentAvailable = (int) $contentAvailable;

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
        $this->data = $data;

        return $this;
    }

    /**
     * Set a key/value pair in the data array.
     *
     * @param string|int $key
     * @param mixed $value
     *
     * @return self
     */
    public function addData($key, $value)
    {
        if (!is_string($key) && !is_int($key)) {
            throw new \InvalidArgumentException('Data keys must be of type "string" or "integer".');
        }

        $data = $this->getData();

        $data[$key] = $value;

        return $this->setData($data);
    }

    /**
     * Get the action array.
     *
     * @return array
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the action array.
     *
     * @param array $action
     *
     * @return self
     */
    public function setAction(array $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set a key/value pair in the data array.
     *
     * @param string|int $key
     * @param mixed $value
     *
     * @return self
     */
    public function addAction(array $data)
    {
        $action = $this->getAction();

        $action[] = $data;

        return $this->setAction($action);
    }

    /**
     * Get the value of the payload "alert" key.
     *
     * @return string|array
     */
    private function getPayloadAlertKeyValue()
    {
        // Alert "string" (simple alert)
        if ($this->getSimpleAlert()) {
            return $this->getSimpleAlert();
        }

        // Alert "array" (complex alert)
        $payloadAlert = array();

        if ($this->getAlertTitle()) {
            $payloadAlert['title'] = $this->getAlertTitle();
        }
        if ($this->getAlertBody()) {
            $payloadAlert['body'] = $this->getAlertBody();
        }
        if ($this->getAlertTitleLocKey()) {
            $payloadAlert['title-loc-key'] = $this->getAlertTitleLocKey();
        }
        if ($this->getAlertTitleLocArgs()) {
            $payloadAlert['title-loc-args'] = $this->getAlertTitleLocArgs();
        }
        if ($this->getAlertActionLocKey()) {
            $payloadAlert['action-loc-key'] = $this->getAlertActionLocKey();
        }
        if ($this->getAlertLocKey()) {
            $payloadAlert['loc-key'] = $this->getAlertLocKey();
        }
        if ($this->getAlertLocArgs()) {
            $payloadAlert['loc-args'] = $this->getAlertLocArgs();
        }
        if ($this->getAlertLaunchImage()) {
            $payloadAlert['launch-image'] = $this->getAlertLaunchImage();
        }
        if ($this->getAction()) {
            $payloadAlert['action'] = $this->getAction();
        }

        return $payloadAlert;
    }
}
