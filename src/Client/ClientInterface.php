<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Client;

use LinkValue\MobileNotif\Model\Message;

/**
 * ClientInterface
 * Interface to implement on a Client class.
 *
 * @package MobileNotif
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
interface ClientInterface
{
    /**
     * Push a notification to a mobile client.
     *
     * @param Message $message
     */
    public function push(Message $message);
}
