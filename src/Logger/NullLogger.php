<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\Logger;

use Psr\Log\LoggerInterface;

/**
 * Logger implementation which does nothing.
 *
 * @author Oliver Thebault <oliver.thebault@link-value.fr>
 */
class NullLogger implements LoggerInterface
{
    /**
     * {@inheritdoc}
     */
    public function emergency($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function alert($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function critical($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function warning($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function notice($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = array())
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        return;
    }

}
