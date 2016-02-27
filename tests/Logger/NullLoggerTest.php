<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Logger;
use LinkValue\MobileNotif\Logger\NullLogger;

/**
 * NullLoggerTest.
 *
 * @author Oliver Thebault <oliver.thebault@link-value.fr>
 */
class NullLoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Object
     */
    private $logger;

    /**
     * Unit tests setUp.
     */
    protected function setUp()
    {
        $this->logger = new NullLogger();
    }

    /**
     * @test
     */
    public function testEmergency()
    {
        $this->assertNull($this->logger->emergency('message'));
    }

    /**
     * @test
     */
    public function testAlert()
    {
        $this->assertNull($this->logger->alert('message'));
    }

    /**
     * @test
     */
    public function testCritical()
    {
        $this->assertNull($this->logger->critical('message'));
    }

    /**
     * @test
     */
    public function testError()
    {
        $this->assertNull($this->logger->error('message'));
    }

    /**
     * @test
     */
    public function testWarning()
    {
        $this->assertNull($this->logger->warning('message'));
    }

    /**
     * @test
     */
    public function testNotice()
    {
        $this->assertNull($this->logger->notice('message'));
    }

    /**
     * @test
     */
    public function testInfo()
    {
        $this->assertNull($this->logger->info('message'));
    }

    /**
     * @test
     */
    public function testDebug()
    {
        $this->assertNull($this->logger->debug('message'));
    }

    /**
     * @test
     */
    public function testLog()
    {
        $this->assertNull($this->logger->log('level', 'message'));
    }

}
