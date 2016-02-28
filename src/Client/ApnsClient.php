<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Client;

use LinkValue\MobileNotif\Logger\ClientLoggableTrait;
use LinkValue\MobileNotif\Logger\NullLogger;
use LinkValue\MobileNotif\Exception\PushException;
use LinkValue\MobileNotif\Model\Message;

/**
 * Apple Push Notification Service client implementation.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class ApnsClient implements ClientInterface
{
    use ClientLoggableTrait;

    /**
     * Push server params.
     *
     * @var array
     */
    private $params;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    /**
     * Set up parameters.
     *
     * @param array $params
     *
     * @throws \RuntimeException
     */
    public function setUp(array $params)
    {
        if (empty($params['endpoint'])) {
            throw new \RuntimeException('Parameter "endpoint" cannot be empty.');
        }

        if (empty($params['ssl_pem_path'])) {
            throw new \RuntimeException('Parameter "ssl_pem_path" cannot be empty.');
        }

        if (!is_readable($params['ssl_pem_path'])) {
            throw new \RuntimeException('"ssl_pem_path" file does not exist or is not readable.');
        }

        $this->params = $params;
    }

    /**
     * Send $message to a mobile client.
     *
     * @param Message $message
     *
     * @throws \RuntimeException if setUp method was not called.
     * @throws PushException if connection to APNS server failed.
     */
    public function push(Message $message)
    {
        if (empty($this->params)) {
            throw new \RuntimeException('Please set up this client using setUp() method before pushing messages.');
        }

        $tokens = $message->getTokens();
        if (empty($tokens)) {
            throw new \RuntimeException('No device token set. Please add at least 1 token using Message::addToken() before trying to push the message.');
        }

        $this->logger->info('Connecting to APNS server');
        $stream = $this->getStreamSocketClient();

        $payload = $message->getPayloadAsJson();

        foreach ($tokens as $token) {
            $this->logger->info('Sending message to APNS server.', array(
                'deviceToken' => $token,
                'payload' => $payload,
            ));
            $this->writePayloadOnStreamForGivenToken($payload, $stream, $token);
        }

        fclose($stream);
    }

    /**
     * Get the Stream socket client.
     *
     * Connect to the APNS server and open a client socket to it.
     *
     * @return resource Socket to the APNS server.
     *
     * @throws PushException if connection to APNS server failed.
     */
    private function getStreamSocketClient()
    {
        $stream_socket_client = stream_socket_client(
            $this->params['endpoint'],
            $errno,
            $errstr,
            30,
            STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
            $this->getStreamContext()
        );

        if ($stream_socket_client === false) {
            throw new PushException('An error occurred while trying to contact APNS server.');
        }

        return $stream_socket_client;
    }

    /**
     * Get secured stream context from SSL certificate.
     *
     * @return resource
     */
    private function getStreamContext()
    {
        $context = array(
            'ssl' => array(
                'local_cert' => $this->params['ssl_pem_path'],
            ),
        );

        // Handle Certificate Bundle passphrase
        if (!empty($this->params['ssl_passphrase'])) {
            $context['ssl']['passphrase'] = $this->params['ssl_passphrase'];
        }

        return stream_context_create($context);
    }

    /**
     * Write $payload on $stream, it will be sent to given device $token.
     *
     * @param $payload
     * @param $stream
     * @param $token
     */
    private function writePayloadOnStreamForGivenToken($payload, $stream, $token)
    {
        $binaryMessage = sprintf('%s%s%s%s%s',
            chr(0),
            pack('n', 32),
            pack('H*', str_replace(' ', '', $token)),
            pack('n', strlen($payload)),
            $payload
        );

        fwrite($stream, $binaryMessage, strlen($binaryMessage));
    }
}
