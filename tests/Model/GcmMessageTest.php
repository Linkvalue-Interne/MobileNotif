<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Model;

use LinkValue\MobileNotif\Model\GcmMessage;

/**
 * GcmMessageTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class GcmMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GcmMessage
     */
    private $message;

    /**
     * @var \ReflectionClass
     */
    private $reflectedClass;

    /**
     * Unit tests setUp.
     */
    protected function setUp()
    {
        $this->reflectedClass = new \ReflectionClass('LinkValue\MobileNotif\Model\GcmMessage');
        $this->message = new GcmMessage();
    }

    /**
     * @test
     */
    public function testConstructor()
    {
        $properties = array(
            'notificationTitleLocArgs',
            'notificationBodyLocArgs',
            'data',
        );

        $valid = true;

        foreach ($properties as $property) {
            $property = $this->reflectedClass->getProperty($property);
            $property->setAccessible(true);

            $valid = $valid && is_array($property->getValue($this->message));
        }

        $this->assertTrue($valid);
    }

    /**
     * @test
     */
    public function testSetTokensMoreThanOneThousand()
    {
        $this->setExpectedException('RuntimeException');

        $values = array();

        for ($i=0; $i < 1001; $i++) {
            $values[] = 'token_'.$i;
        }

        $this->message->setTokens($values);
    }

    /**
     * @test
     */
    public function testAddTokensMoreThanOneThousand()
    {
        $this->setExpectedException('RuntimeException');

        $values = array();

        for ($i=0; $i < 1000; $i++) {
            $values[] = 'token_'.$i;
        }

        $this->message->setTokens($values);
        $this->message->addToken('token_1000');
    }

    /**
     * @test
     */
    public function testSetCollapseKey()
    {
        $value = 'my collapse key';

        $this->message->setCollapseKey($value);

        $property = $this->reflectedClass->getProperty('collapseKey');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetCollapseKey()
    {
        $value = 'my collapse key';

        $property = $this->reflectedClass->getProperty('collapseKey');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getCollapseKey() == $value);
    }

    /**
     * @test
     */
    public function testSetPriorityWrongValue()
    {
        $this->setExpectedException('RuntimeException');

        $this->message->setPriority('my_priority');
    }

    /**
     * @test
     */
    public function testSetPriorityHigh()
    {
        $value = 'high';

        $this->message->setPriority($value);

        $property = $this->reflectedClass->getProperty('priority');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testSetPriorityNormal()
    {
        $value = 'normal';

        $this->message->setPriority($value);

        $property = $this->reflectedClass->getProperty('priority');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetPriorityDefaultValue()
    {
        $this->assertTrue($this->message->getPriority() == GcmMessage::DEFAULT_PRIORITY);
    }

    /**
     * @test
     */
    public function testGetPriority()
    {
        $value = 'normal';

        $property = $this->reflectedClass->getProperty('priority');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getPriority() == $value);
    }

    /**
     * @test
     */
    public function testSetContentAvailable()
    {
        $value = true;

        $this->message->setContentAvailable($value);

        $property = $this->reflectedClass->getProperty('contentAvailable');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetContentAvailable()
    {
        $value = true;

        $property = $this->reflectedClass->getProperty('contentAvailable');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getContentAvailable();

        $this->assertTrue(is_bool($valueByReflection) && ($valueByReflection == $value));
    }

    /**
     * @test
     */
    public function testSetDelayWhileIdle()
    {
        $value = true;

        $this->message->setDelayWhileIdle($value);

        $property = $this->reflectedClass->getProperty('delayWhileIdle');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetDelayWhileIdle()
    {
        $value = true;

        $property = $this->reflectedClass->getProperty('delayWhileIdle');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getDelayWhileIdle();

        $this->assertTrue(is_bool($valueByReflection) && ($valueByReflection == $value));
    }

    /**
     * @test
     */
    public function testSetTimeToLive()
    {
        $value = 1;

        $this->message->setTimeToLive($value);

        $property = $this->reflectedClass->getProperty('timeToLive');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetTimeToLive()
    {
        $value = 1;

        $property = $this->reflectedClass->getProperty('timeToLive');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getTimeToLive();

        $this->assertTrue(is_int($valueByReflection) && ($valueByReflection == $value));
    }

    /**
     * @test
     */
    public function testSetRestrictedPackageName()
    {
        $value = 'my restricted package name';

        $this->message->setRestrictedPackageName($value);

        $property = $this->reflectedClass->getProperty('restrictedPackageName');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetRestrictedPackageName()
    {
        $value = 'my restricted package name';

        $property = $this->reflectedClass->getProperty('restrictedPackageName');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getRestrictedPackageName() == $value);
    }

    /**
     * @test
     */
    public function testSetDryRun()
    {
        $value = true;

        $this->message->setDryRun($value);

        $property = $this->reflectedClass->getProperty('dryRun');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetDryRun()
    {
        $value = true;

        $property = $this->reflectedClass->getProperty('dryRun');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getDryRun();

        $this->assertTrue(is_bool($valueByReflection) && ($valueByReflection == $value));
    }

    /**
     * @test
     */
    public function testSetNotificationTitle()
    {
        $value = 'my notification title';

        $this->message->setNotificationTitle($value);

        $property = $this->reflectedClass->getProperty('notificationTitle');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationTitle()
    {
        $value = 'my notification title';

        $property = $this->reflectedClass->getProperty('notificationTitle');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationTitle() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationBody()
    {
        $value = 'my notification body';

        $this->message->setNotificationBody($value);

        $property = $this->reflectedClass->getProperty('notificationBody');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationBody()
    {
        $value = 'my notification body';

        $property = $this->reflectedClass->getProperty('notificationBody');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationBody() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationIcon()
    {
        $value = 'my notification icon';

        $this->message->setNotificationIcon($value);

        $property = $this->reflectedClass->getProperty('notificationIcon');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationIcon()
    {
        $value = 'my notification icon';

        $property = $this->reflectedClass->getProperty('notificationIcon');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationIcon() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationSound()
    {
        $value = 'my notification sound';

        $this->message->setNotificationSound($value);

        $property = $this->reflectedClass->getProperty('notificationSound');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationSound()
    {
        $value = 'my notification sound';

        $property = $this->reflectedClass->getProperty('notificationSound');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationSound() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationBadge()
    {
        $value = 'my notification badge';

        $this->message->setNotificationBadge($value);

        $property = $this->reflectedClass->getProperty('notificationBadge');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationBadge()
    {
        $value = 'my notification badge';

        $property = $this->reflectedClass->getProperty('notificationBadge');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationBadge() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationTag()
    {
        $value = 'my notification tag';

        $this->message->setNotificationTag($value);

        $property = $this->reflectedClass->getProperty('notificationTag');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationTag()
    {
        $value = 'my notification tag';

        $property = $this->reflectedClass->getProperty('notificationTag');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationTag() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationColor()
    {
        $value = 'my notification color';

        $this->message->setNotificationColor($value);

        $property = $this->reflectedClass->getProperty('notificationColor');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationColor()
    {
        $value = 'my notification color';

        $property = $this->reflectedClass->getProperty('notificationColor');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationColor() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationClickAction()
    {
        $value = 'notification click action';

        $this->message->setNotificationClickAction($value);

        $property = $this->reflectedClass->getProperty('notificationClickAction');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationClickAction()
    {
        $value = 'notification click action';

        $property = $this->reflectedClass->getProperty('notificationClickAction');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationClickAction() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationBodyLocKey()
    {
        $value = 'notification body loc key';

        $this->message->setNotificationBodyLocKey($value);

        $property = $this->reflectedClass->getProperty('notificationBodyLocKey');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationBodyLocKey()
    {
        $value = 'notification body loc key';

        $property = $this->reflectedClass->getProperty('notificationBodyLocKey');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationBodyLocKey() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationBodyLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $this->message->setNotificationBodyLocArgs($values);

        $property = $this->reflectedClass->getProperty('notificationBodyLocArgs');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    /**
     * @test
     */
    public function testGetNotificationBodyLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $property = $this->reflectedClass->getProperty('notificationBodyLocArgs');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getNotificationBodyLocArgs() == $values);
    }

    /**
     * @test
     */
    public function testSetNotificationTitleLocKey()
    {
        $value = 'my notification title loc key';

        $this->message->setNotificationTitleLocKey($value);

        $property = $this->reflectedClass->getProperty('notificationTitleLocKey');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetNotificationTitleLocKey()
    {
        $value = 'my notification title loc key';

        $property = $this->reflectedClass->getProperty('notificationTitleLocKey');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationTitleLocKey() == $value);
    }

    /**
     * @test
     */
    public function testSetNotificationTitleLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $this->message->setNotificationTitleLocArgs($values);

        $property = $this->reflectedClass->getProperty('notificationTitleLocArgs');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    /**
     * @test
     */
    public function testGetNotificationTitleLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $property = $this->reflectedClass->getProperty('notificationTitleLocArgs');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getNotificationTitleLocArgs() == $values);
    }

    /**
     * @test
     *
     * @dataProvider setDataProvider
     */
    public function testSetData($data, $exception)
    {
        if ($exception) {
            $this->setExpectedException($exception);
        }

        $this->message->setData($data);

        $property = $this->reflectedClass->getProperty('data');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $data);
    }

    /**
     * Data Provider for testSetData
     */
    public function setDataProvider()
    {
        return array(

            // keys are string, contains google/gcm but not at the bottom
            array(
                array(
                    'key1' => 'value1',
                    'key2google' => 'value2',
                    'key3gcm' => 'value3',
                ),
                null
            ),

            // key is not a string (0 => 'value1')
            array(
                array(
                    'value1',
                ),
                'InvalidArgumentException'
            ),

            // key is reserved
            array(
                array(
                    'from' => 'value1',
                ),
                'InvalidArgumentException'
            ),

            // key begin with google
            array(
                array(
                    'google1' => 'value1',
                ),
                'InvalidArgumentException'
            ),

            // key begin with gcm
            array(
                array(
                    'gcm1' => 'value1',
                ),
                'InvalidArgumentException'
            ),

        );
    }

    /**
     * @test
     */
    public function testGetData()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $property = $this->reflectedClass->getProperty('data');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getData() == $values);
    }

    /**
     * @test
     */
    public function testAddDataWithoutStringKey()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->message->addData(array('invalid data key'), 'value1');
    }

    /**
     * @test
     */
    public function testAddData()
    {
        $key1 = 'key1';
        $value1 = 'value1';

        $this->message->addData($key1, $value1);

        $property = $this->reflectedClass->getProperty('data');
        $property->setAccessible(true);

        $data = $property->getValue($this->message);

        $this->assertTrue(isset($data[$key1]) && ($data[$key1] == $value1));
    }

    /**
     * @test
     */
    public function testGetPayloadWithSingleTokenAndNothingElseSet()
    {
        $this->message
            ->addToken('01234')
        ;

        $this->assertEquals(
            array(
                'to' => '01234',
                'notification' => array(),
            ),
            $this->message->getPayload()
        );
    }

    /**
     * @test
     */
    public function testGetPayloadWithMultipleTokensAndFullMessageSet()
    {
        $this->message
            ->setTokens(array('0', '1', '2'))
            ->setNotificationTitle('something')
            ->setNotificationBody('something')
            ->setNotificationIcon('something')
            ->setNotificationSound('something')
            ->setNotificationTag('something')
            ->setNotificationBadge('something')
            ->setNotificationColor('something')
            ->setNotificationClickAction('something')
            ->setNotificationBodyLocKey('something')
            ->setNotificationBodyLocArgs(array('something' => 'something'))
            ->setNotificationTitleLocKey('something')
            ->setNotificationTitleLocArgs(array('something' => 'something'))
            ->setCollapseKey('something')
            ->setPriority('high')
            ->setRestrictedPackageName('something')
            ->setContentAvailable(false)
            ->setDelayWhileIdle(false)
            ->setDryRun(false)
            ->setTimeToLive(1234)
            ->setData(array('something' => 'something'))
        ;

        $this->assertEquals(
            array(
                'registration_ids' => array(
                    '0',
                    '1',
                    '2',
                ),
                'collapse_key' => 'something',
                'priority' => 'high',
                'restricted_package_name' => 'something',
                'content_available' => false,
                'delay_while_idle' => false,
                'dry_run' => false,
                'time_to_live' => 1234,
                'data' => array(
                    'something' => 'something',
                ),
                'notification' => array(
                    'title' => 'something',
                    'body' => 'something',
                    'icon' => 'something',
                    'sound' => 'something',
                    'tag' => 'something',
                    'badge' => 'something',
                    'color' => 'something',
                    'click_action' => 'something',
                    'body_loc_key' => 'something',
                    'body_loc_args' => array(
                        'something' => 'something',
                    ),
                    'title_loc_key' => 'something',
                    'title_loc_args' => array(
                        'something' => 'something',
                    ),
                ),
            ),
            $this->message->getPayload()
        );
    }
}
