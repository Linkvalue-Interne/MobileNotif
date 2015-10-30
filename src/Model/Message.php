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
  *
  * @package MobileNotif
  * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
  * @author  Valentin Coulon <valentin.c0610@gmail.com>
  */
class Message
{
    /**
     * The devices token
     * @var array
     */
    protected $tokens;

    /**
     * The message content
     * @var string
     */
    protected $content;

    /**
     * The message arguments
     * @var array
     */
    protected $arguments;

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->args = array();
        $this->data = array();
        $this->tokens = array();
    }

    /**
     * Get the value of the devices token
     *
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Set the value of the devices token
     *
     * @param array tokens
     *
     * @return self
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;

        return $this;
    }

    /**
     * Add the value of the device token
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

    /**
     * Get the value of the message content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of the message content
     *
     * @param string content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of the message arguments
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Set the value of the message arguments
     *
     * @param array arguments
     *
     * @return self
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get the value of data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
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

}
