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
 * @package MobileNotif
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
     * Push server endpoint
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $ssl_pem_path;

    /**
     * @var string
     */
    protected $ssl_passphrase;

    /**
     * ApplePushNotificationClient constructor.
     *
     * @param LoggerInterface $logger
     *
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set up the arguments from the configuration file
     *
     * @param array $params
     *
     * @throws \FileNotFoundException
     */
    public function setUp(array $params)
    {
        if (!isset($params['endpoint']))
            throw new \RuntimeException('Parameter "endpoint" missing.');

        if (!isset($params['ssl_pem_path']))
            throw new \RuntimeException('Parameter "ssl_pem_path" missing.');

        if (!isset($params['ssl_passphrase']))
            throw new \RuntimeException('Parameter "ssl_passphrase" missing.');

        if (!file_exists($params['ssl_pem_path']))
            throw new \RuntimeException('File does not exist.');

        $this->endpoint = $params['endpoint'];
        $this->ssl_pem_path = $params['ssl_pem_path'];
        $this->ssl_passphrase = $params['ssl_passphrase'];
    }

    /**
     * Push a notification to a mobile client.
     *
     * @param Message $message
     */
    public function push(Message $message)
    {
        $stream = $this->getStreamSocketClient();

        $payload = $this->getPayload($message);

        $binaryMessage = sprintf('%s%s%s%s%s', chr(0), pack('n', 32), pack('H*', str_replace(' ', '', $message->getToken())), pack('n', strlen($payload)), $payload);

        $this->logger->info('Sending message to Apple push notification server', array(
            'deviceToken' => $message->getToken(),
            'payload' => $payload,
        ));

        fwrite($stream, $binaryMessage, strlen($binaryMessage));

        fclose($stream);
    }

    protected function getStreamContext()
    {
        return stream_context_create(array(
            'ssl' => array(
                'local_cert' => $this->ssl_pem_path,
                'passphrase' => $this->ssl_passphrase,
            ),
        ));
    }

    protected function getPayload(Message $message)
    {
        $payload = array(
            'aps'  => array(
                'badge' => 1,
                'sound' => 'default',
                'alert' => array(
                    'loc-key' => $message->getContent(),
                ),
            ),
            'data' => $message->getData(),
        );

        if ($args = $message->getArguments()) {

            $payload['aps']['alert']['loc-args'] = array();

            foreach ($args as $arg) {
                $payload['aps']['alert']['loc-args'][] = $arg;
            }
        }

        return json_encode($payload);
    }

    protected function getStreamSocketClient()
    {
        $stream_context = $this->getStreamContext();

        $this->logger->info('Connecting to Apple push notification server');

        $stream_socket_client = stream_socket_client($this->endpoint, $errno, $errstr, 30, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $stream_context);

        if ($stream_socket_client == false)
            throw new PushException('An error occured while trying to contact Apple push notification server.');

        return $stream_socket_client;
    }
}
