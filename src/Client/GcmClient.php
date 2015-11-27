<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Client;

use Psr\Log\LoggerInterface;
use LinkValue\MobileNotif\Model\Message;

/**
 * GcmClient
 * Google Cloud Messaging implementation.
 *
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
     * Push server params.
     *
     * @var array
     */
    protected $params;

    /**
     * AndroidPushNotificationClient constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set up the parameters.
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

        if (!isset($params['api_access_key'])) {
            throw new \RuntimeException('Parameter "api_access_key" missing.');
        }

        $this->params = $params;
    }

    /**
     * Push a notification to a mobile client.
     *
     * @param GcmMessage $message
     */
    public function push(Message $message)
    {
        if (empty($this->params)) {
            throw new \RuntimeException('Please setUp the client before pushing messages.');
        }

        $payload = $message->getPayloadAsJson();

        $headers = array(
            'Authorization: key='.$this->params['api_access_key'],
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->params['endpoint']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $this->logger->info('Sending GcmMessage to Google Cloud Messaging server', array(
            'payload' => $payload,
        ));

        curl_exec($ch);
        curl_close($ch);
    }
}
