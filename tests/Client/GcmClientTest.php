<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Client;

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;

/**
 * GcmClientTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class GcmClientTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');

        $this->client = new GcmClient($logger);
    }

    public function testSetUp()
    {
        $this->client->setUp(array(
            'api_access_key' => 'my api access key',
            'endpoint' => 'https://android.googleapis.com/gcm/send',
        ));

        $reflectedClass = new \ReflectionClass("LinkValue\MobileNotif\Client\GcmClient");
        $property = $reflectedClass->getProperty('params');
        $property->setAccessible(true);

        $params = $property->getValue($this->client);

        $this->assertTrue(isset($params['api_access_key']) && isset($params['endpoint']));
    }

    public function testPushWithoutSetUp()
    {
        $this->setExpectedException('RuntimeException');

        $message = new GcmMessage();
        $message->addToken('this is the token');
        $message->setNotificationTitle('This is the message title');
        $message->setNotificationBody('This is the message body');

        $this->client->push($message);
    }

    public function testMissingEndpoint()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'api_access_key' => 'my api access key',
        ));
    }

    public function testMissingApiAccessKey()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => 'https://android.googleapis.com/gcm/send',
        ));
    }
}
