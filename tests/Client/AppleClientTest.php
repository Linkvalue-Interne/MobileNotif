<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Client;

use LinkValue\MobileNotif\Client\AppleClient;
use LinkValue\MobileNotif\Model\AppleMessage;

/**
 * AppleClientTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class AppleClientTest extends \PHPUnit_Framework_TestCase
{
    private function getAppleClientMock()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface');

        $client = new AppleClient($logger);

        return $client;
    }

    public function testPushWithoutSetUp()
    {
        $this->setExpectedException('RuntimeException');

        $message = new AppleMessage();
        $message->addToken('this is the token');
        $message->setAlertTitle('This is the message title');
        $message->setAlertBody('This is the message body');

        $client = $this->getAppleClientMock();
        $client->push($message);
    }

    public function testMissingEndpoint()
    {
        $this->setExpectedException('RuntimeException');

        $client = $this->getAppleClientMock();
        $client->setUp(array(
            'ssl_pem_path' => 'data/file.pem',
            'ssl_passphrase' => 'my passphrase',
        ));
    }

    public function testMissingSslPemPath()
    {
        $this->setExpectedException('RuntimeException');

        $client = $this->getAppleClientMock();
        $client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_passphrase' => 'my passphrase',
        ));
    }

    public function testMissingSslPassphrase()
    {
        $this->setExpectedException('RuntimeException');

        $client = $this->getAppleClientMock();
        $client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_pem_path' => 'data/file.pem',
        ));
    }
}
