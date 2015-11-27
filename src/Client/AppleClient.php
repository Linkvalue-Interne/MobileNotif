<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Client;

use Psr\Log\LoggerInterface;
use LinkValue\MobileNotif\Exception\PushException;
use LinkValue\MobileNotif\Model\Message;

/**
 * AppleClient
 * Apple Push Notification services implementation.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class AppleClient implements ClientInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Push server params.
     *
     * @var array
     */
    protected $params;

    /**
     * AppleClient constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set up the arguments from the configuration file.
     *
     * @param array $params
     *
     * @throws \RuntimeException
     */
    public function setUp(array $params)
    {
        if (!isset($params['endpoint'])) {
            throw new \RuntimeException('Parameter "endpoint" missing.');
        }

        if (!isset($params['ssl_pem_path'])) {
            throw new \RuntimeException('Parameter "ssl_pem_path" missing.');
        }

        if (!isset($params['ssl_passphrase'])) {
            throw new \RuntimeException('Parameter "ssl_passphrase" missing.');
        }

        if (!file_exists($params['ssl_pem_path'])) {
            throw new \RuntimeException('File does not exist.');
        }

        $this->params = $params;
    }

    /**
     * Push a notification to a mobile client.
     *
     * @param Message $message
     */
    public function push(Message $message)
    {
        if (empty($this->params)) {
            throw new \RuntimeException('Please setUp the client before pushing messages.');
        }

        $stream = $this->getStreamSocketClient();

        $payload = $message->getPayloadAsJson();

        foreach ($message->getTokens() as $token) {
            $binaryMessage = sprintf('%s%s%s%s%s', chr(0), pack('n', 32), pack('H*', str_replace(' ', '', $token)), pack('n', strlen($payload)), $payload);

            $this->logger->info('Sending message to Apple push notification server', array(
                'deviceToken' => $token,
                'payload' => $payload,
            ));

            fwrite($stream, $binaryMessage, strlen($binaryMessage));

            fclose($stream);
        }
    }

    /**
    * Get the stream context
    * Create an ssl connexion from config parameters.
    *
    * @return ressource
    */
    protected function getStreamContext()
    {
        return stream_context_create(array(
            'ssl' => array(
                'local_cert' => $this->params['ssl_pem_path'],
                'passphrase' => $this->params['ssl_passphrase'],
            ),
        ));
    }

    /**
     * Get the Stream socket client
     *
     * Connect to the apple push notification server and open a client socket to it.
     *
     * @return ressource socket to the apple push client
     *
     * @throws PushException
     */
    protected function getStreamSocketClient()
    {
        $stream_context = $this->getStreamContext();

        $this->logger->info('Connecting to Apple push notification server');

        $stream_socket_client = stream_socket_client($this->params['endpoint'], $errno, $errstr, 30, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $stream_context);

        if ($stream_socket_client === false) {
            throw new PushException('An error occured while trying to contact Apple push notification server.');
        }

        return $stream_socket_client;
    }
}
