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
 * Trait which provides tools to log a client implementation.
 *
 * @author Oliver Thebault <oliver.thebault@link-value.fr>
 */
trait ClientLoggableTrait
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param LoggerInterface $logger
     *
     * @return self
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }
}
