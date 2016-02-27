<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Mock some native PHP functions used in tested class.
namespace LinkValue\MobileNotif\Client;

function curl_exec()
{
    return true;
}

namespace LinkValue\MobileNotif\tests\Client;

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;
use Prophecy\Argument;

/**
 * GcmClientTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class GcmClientTest extends \PHPUnit_Framework_TestCase
{
    const GCM_TEST_ENDPOINT = 'https://android.googleapis.com/gcm/send';

    /**
     * @var GcmClient
     */
    protected $client;

    /**
     * @var Object
     */
    private $logger;

    /**
     * Unit tests setUp.
     */
    protected function setUp()
    {
        $this->logger = $this->prophesize('Psr\Log\LoggerInterface');
        $this->client = (new GcmClient())->setLogger($this->logger->reveal());
    }

    /**
     * @test
     */
    public function testSetUpWithMissingEndpoint()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'api_access_key' => 'API ACCESS KEY',
        ));
    }

    /**
     * @test
     */
    public function testSetUpWithMissingApiAccessKey()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => self::GCM_TEST_ENDPOINT,
        ));
    }

    /**
     * @test
     */
    public function testSetUp()
    {
        $this->client->setUp(array(
            'api_access_key' => 'API ACCESS KEY',
            'endpoint' => self::GCM_TEST_ENDPOINT,
        ));

        $reflectedClass = new \ReflectionClass('LinkValue\MobileNotif\Client\GcmClient');
        $property = $reflectedClass->getProperty('params');
        $property->setAccessible(true);

        $params = $property->getValue($this->client);

        $this->assertTrue(
            isset($params['api_access_key'])
            && isset($params['endpoint'])
        );
    }

    /**
     * @test
     */
    public function testPushWithoutSetUp()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->push((new GcmMessage())->addToken('DEVICE TOKEN'));
    }

    /**
     * @test
     */
    public function testPush()
    {
        $this->client->setUp(array(
            'api_access_key' => 'API ACCESS KEY',
            'endpoint' => self::GCM_TEST_ENDPOINT,
        ));

        $message = (new GcmMessage())
            ->addToken('0123456789abcdef')
        ;

        $this->client->push($message);

        // logger->info() should be called once while sending GcmMessage to all tokens
        $this->logger->info(Argument::type('string'), Argument::any())->shouldHaveBeenCalledTimes(1);
    }
}
