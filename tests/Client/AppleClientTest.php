<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Client;

function file_exists()
{
    return true;
}
/*
function stream_socket_client()
{
    var_dump("ok");exit;
}
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
    protected $client;

    protected $reflectedClass;

    protected function setUp()
    {
        $logger = $this->getMock('Psr\Log\LoggerInterface', array('info'));

        $this->client = new AppleClient($logger);
        $this->reflectedClass = new \ReflectionClass("LinkValue\MobileNotif\Client\AppleClient");
    }

    public function testSetUp()
    {
        $this->client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_pem_path' => 'data/file.pem',
            'ssl_passphrase' => 'my passphrase',
        ));

        $property = $this->reflectedClass->getProperty('params');
        $property->setAccessible(true);

        $params = $property->getValue($this->client);

        $this->assertTrue(isset($params['endpoint']) && isset($params['ssl_pem_path']) && isset($params['ssl_passphrase']));
    }

    public function testPushWithoutSetUp()
    {
        $this->setExpectedException('RuntimeException');

        $message = new AppleMessage();
        $message->addToken('this is the token');
        $message->setAlertTitle('This is the message title');
        $message->setAlertBody('This is the message body');

        $this->client->push($message);
    }

    public function testMissingEndpoint()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'ssl_pem_path' => 'data/file.pem',
            'ssl_passphrase' => 'my passphrase',
        ));
    }

    public function testMissingSslPemPath()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_passphrase' => 'my passphrase',
        ));
    }

    public function testMissingSslPassphrase()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_pem_path' => 'data/file.pem',
        ));
    }

    public function testGetStreamContext()
    {
        $this->client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_pem_path' => 'data/file.pem',
            'ssl_passphrase' => 'my passphrase',
        ));

        $method = $this->reflectedClass->getMethod('getStreamContext');
        $method->setAccessible(true);

        $context = $method->invoke($this->client);

        $this->assertTrue(is_resource($context));
    }
    /*
    public function testGetStreamSocketClient()
    {
        $this->client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
            'ssl_pem_path' => 'data/file.pem',
            'ssl_passphrase' => 'my passphrase',
        ));

        $method = $this->reflectedClass->getMethod('getStreamSocketClient');
        $method->setAccessible(true);

        $context = $method->invoke($this->client);

        $this->assertTrue(is_resource($context));
    }

    public function testGetStreamSocketClientFailedToPush()
    {
        $this->setExpectedException('LinkValue\MobileNotif\Exception\PushException');

        $this->client->setUp(array(
            'endpoint' => 'tls://gateway.sandbox.push.apple.com:80',
            'ssl_pem_path' => 'data/file.pem',
            'ssl_passphrase' => 'my passphrase',
        ));

        $method = $this->reflectedClass->getMethod('getStreamSocketClient');
        $method->setAccessible(true);

        $context = $method->invoke($this->client);
    }
    */
}
