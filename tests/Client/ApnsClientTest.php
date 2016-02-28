<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Mock some native PHP functions used in tested class.
namespace LinkValue\MobileNotif\Client;

define('TEST_OUTPUT_GARBAGE', realpath(__DIR__ . '/../') . '/output_garbage');

function stream_context_create()
{
    return fopen(TEST_OUTPUT_GARBAGE, 'a+');
}

function stream_socket_client($endpoint, &$errno = null, &$errstr = null)
{
    if($endpoint !== \LinkValue\MobileNotif\tests\Client\ApnsClientTest::APNS_TEST_ENDPOINT){
        return false;
    }

    return fopen(TEST_OUTPUT_GARBAGE, 'a+');
}

namespace LinkValue\MobileNotif\tests\Client;

use LinkValue\MobileNotif\Client\ApnsClient;
use LinkValue\MobileNotif\Model\ApnsMessage;
use Prophecy\Argument;

/**
 * Test ApnsClient class.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class ApnsClientTest extends \PHPUnit_Framework_TestCase
{
    const APNS_TEST_ENDPOINT = 'tls://gateway.sandbox.push.apple.com:2195';

    /**
     * @var ApnsClient
     */
    private $client;

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
        $this->client = (new ApnsClient())->setLogger($this->logger->reveal());
    }

    /**
     * Unit test class tearDown.
     */
    public static function tearDownAfterClass()
    {
        // remove garbage file
        unlink(TEST_OUTPUT_GARBAGE);
    }

    /**
     * @test
     */
    public function testSetUpWithMissingEndpoint()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'ssl_pem_path' => 'some/unexisting_path/to/file.pem',
        ));
    }

    /**
     * @test
     */
    public function testSetUpWithMissingSslPemPath()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => self::APNS_TEST_ENDPOINT,
        ));
    }

    /**
     * @test
     */
    public function testSetUpWithUnexistingSslPemFile()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => self::APNS_TEST_ENDPOINT,
            'ssl_pem_path' => 'some/unexisting_path/to/file.pem',
        ));
    }

    /**
     * @test
     */
    public function testSetUp()
    {
        $this->client->setUp(array(
            'endpoint' => self::APNS_TEST_ENDPOINT,
            'ssl_pem_path' => realpath(__DIR__ . '/../Stubs/SslCertificateStub.pem'),
            'ssl_passphrase' => 'PASSPHRASE',
        ));

        $clientReflected = new \ReflectionClass('LinkValue\MobileNotif\Client\ApnsClient');
        $paramsReflectedProperty = $clientReflected->getProperty('params');
        $paramsReflectedProperty->setAccessible(true);
        $clientParams = $paramsReflectedProperty->getValue($this->client);

        $this->assertTrue(
            isset($clientParams['endpoint'])
            && isset($clientParams['ssl_pem_path'])
            && isset($clientParams['ssl_passphrase'])
        );
    }

    /**
     * @test
     */
    public function testPushWithoutSetUp()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->push((new ApnsMessage())->addToken('DEVICE TOKEN'));
    }

    /**
     * @test
     */
    public function testPushMessageWithoutTokens()
    {
        $this->setExpectedException('RuntimeException');

        $this->client->setUp(array(
            'endpoint' => 'tls://this.endpoint.does.not.exist:9999',
            'ssl_pem_path' => realpath(__DIR__ . '/../Stubs/SslCertificateStub.pem'),
        ));

        $this->client->push((new ApnsMessage()));
    }

    /**
     * @test
     */
    public function testPushWithoutBeingAbleToEstablishConnectionToEndpoint()
    {
        $this->setExpectedException('LinkValue\MobileNotif\Exception\PushException');

        $this->client->setUp(array(
            'endpoint' => 'tls://this.endpoint.does.not.exist:9999',
            'ssl_pem_path' => realpath(__DIR__ . '/../Stubs/SslCertificateStub.pem'),
        ));

        $this->client->push((new ApnsMessage())->addToken('DEVICE TOKEN'));
    }

    /**
     * @test
     */
    public function testPushToSingleDevice()
    {
        $this->client->setUp(array(
            'endpoint' => self::APNS_TEST_ENDPOINT,
            'ssl_pem_path' => realpath(__DIR__ . '/../Stubs/SslCertificateStub.pem'),
        ));

        $message = (new ApnsMessage())
            ->addToken('0123456789abcdef')
        ;

        $this->client->push($message);

        // logger->info() should be called once while establishing connection with APNS, then once for each message sent to a token
        $this->logger->info(Argument::type('string'), Argument::any())->shouldHaveBeenCalledTimes(2);
    }

    /**
     * @test
     */
    public function testPushToMultipleDevices()
    {
        $this->client->setUp(array(
            'endpoint' => self::APNS_TEST_ENDPOINT,
            'ssl_pem_path' => realpath(__DIR__ . '/../Stubs/SslCertificateStub.pem'),
            'ssl_passphrase' => 'PASSPHRASE',
        ));

        $message = (new ApnsMessage())
            ->addToken('0123456789abcdef0')
            ->addToken('0123456789abcdef1')
            ->addToken('0123456789abcdef2')
        ;

        $this->client->push($message);

        // logger->info() should be called once while establishing connection with APNS server, then once for each message sent to a token
        $this->logger->info(Argument::type('string'), Argument::any())->shouldHaveBeenCalledTimes(4);
    }
}
