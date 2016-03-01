<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Model;

/**
 * MessageTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \LinkValue\MobileNotif\Model\Message
     */
    private $message;

    /**
     * @var \ReflectionClass
     */
    private $reflectedClass;

    /**
     * Unit tests setUp.
     */
    protected function setUp()
    {
        $this->reflectedClass = new \ReflectionClass('LinkValue\MobileNotif\Model\Message');
        $this->message = $this->getMockForAbstractClass('LinkValue\MobileNotif\Model\Message');
    }

    /**
     * @test
     */
    public function testConstructor()
    {
        $property = $this->reflectedClass->getProperty('tokens');
        $property->setAccessible(true);

        $this->assertTrue(is_array($property->getValue($this->message)));
    }

    /**
     * @test
     */
    public function testSetTokens()
    {
        $values = array(
            'token_1',
            'token_2',
            'token_3',
        );

        $this->message->setTokens($values);

        $property = $this->reflectedClass->getProperty('tokens');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    /**
     * @test
     */
    public function testGetTokens()
    {
        $values = array(
            'token_1',
            'token_2',
            'token_3',
        );

        $property = $this->reflectedClass->getProperty('tokens');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getTokens() == $values);
    }

    /**
     * @test
     */
    public function testAddToken()
    {
        $value = 'my token';

        $this->message->addToken($value);

        $property = $this->reflectedClass->getProperty('tokens');
        $property->setAccessible(true);

        $this->assertTrue(in_array($value, $property->getValue($this->message)));
    }
}
