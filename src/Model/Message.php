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
 * Definition of message for push notification.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
abstract class Message
{
    /**
     * The devices token.
     *
     * @var array
     */
    protected $tokens;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tokens = array();
    }

    /**
     * Get the Payload message to push
     *
     * @return array
     */
    abstract public function getPayload();

    /**
     * Get the Payload message to push converted in json 
     *
     * @return string json payload message
     */
    public function getPayloadAsJson()
    {
        return json_encode($this->getPayload());
    }

    /**
     * Get the list token devices.
     *
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Set the list of token devices.
     *
     * @param array $tokens
     *
     * @return self
     */
    public function setTokens(array $tokens)
    {
        $this->tokens = array_unique($tokens);

        return $this;
    }

    /**
     * Add a token device.
     *
     * @param string $token
     *
     * @return self
     */
    public function addToken($token)
    {
        if (!in_array($token, $this->tokens)) {
            $this->tokens[] = $token;
        }

        return $this;
    }
}
