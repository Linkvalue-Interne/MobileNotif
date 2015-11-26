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
     * @return array
     */
    abstract public function getPayload();

    /**
     * @return json
     */
    public function getPayloadAsJson()
    {
        return json_encode($this->getPayload());
    }

    /**
     * Get the value of The devices token.
     *
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
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
        $this->tokens[] = $token;

        return $this;
    }
}
