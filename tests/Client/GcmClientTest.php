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
    private function getGcmClientMock()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');

        $client = new GcmClient($logger);

        return $client;
    }

    public function testPushWithoutSetUp()
    {
        $this->setExpectedException('RuntimeException');

        $message = new GcmMessage();
        $message->addToken('this is the token');
        $message->setNotificationTitle('This is the message title');
        $message->setNotificationBody('This is the message body');

        $client = $this->getGcmClientMock();
        $client->push($message);
    }

    public function testMissingEndpoint()
    {
        $this->setExpectedException('RuntimeException');

        $client = $this->getGcmClientMock();
        $client->setUp(array(
            'api_access_key' => 'my api access key',
        ));
    }

    public function testMissingApiAccessKey()
    {
        $this->setExpectedException('RuntimeException');

        $client = $this->getGcmClientMock();
        $client->setUp(array(
            'endpoint' => 'https://android.googleapis.com/gcm/send',
        ));
    }
}
