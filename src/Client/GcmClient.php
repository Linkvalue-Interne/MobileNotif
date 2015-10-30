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
 * GcmClient
 * Google Cloud Messaging implementation.
 *
 * @package MobileNotif
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class GcmClient implements ClientInterface
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
     * Api Access key
     * @var string
     */
    protected $api_access_key;

    /**
     * AndroidPushNotificationClient constructor.
     *
     * @param LoggerInterface $logger
     *
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set up the arguments
     *
     * @param array $params
     *
     * @throws \RuntimeException
     */
    public function setUp(array $params)
    {
        if (!isset($params['endpoint']))
            throw new \RuntimeException('Parameter "endpoint" missing.');

        if (!isset($params['api_access_key']))
            throw new \RuntimeException('Parameter "api_access_key" missing.');

        $this->endpoint = $params['endpoint'];
        $this->api_access_key = $params['api_access_key'];
    }

    /**
     * Push a notification to a mobile client.
     *
     * @param Message $message
     */
    public function push(Message $message)
    {
        $fields = $this->buildFields($message);

        $ch = $this->buildRequest($fields);

        $this->logger->info('Sending message to Google Cloud Messaging server', array(
            'fields' => $fields,
        ));

        curl_exec($ch);
        curl_close($ch);
    }

    protected function buildFields(Message $message)
    {
        return array(
            'registration_ids' => $message->getTokens(),
            'data' => array(
                'title' => 'This is a title. title',
                'message' => $message->getContent(),
                //'subtitle'  => 'This is a subtitle. subtitle',
                //'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
                //'vibrate' => 1,
                //'sound' => 1
            )
        );
    }

    /**
     * Build the cUrl resource
     *
     * @param Message $message
     * @return resource $ch
     */
    protected function buildRequest($fields)
    {
        $headers = array(
            'Authorization: key=' . $this->api_access_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        return $ch;
    }
}
