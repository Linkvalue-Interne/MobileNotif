<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Model;

use LinkValue\MobileNotif\Model\GcmMessage;

include_once __DIR__.'/MessageTest.php';

/**
 * GcmMessageTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class GcmMessageTest extends MessageTest
{
    protected function setUp()
    {
        $this->reflectedClass = new \ReflectionClass("LinkValue\MobileNotif\Model\GcmMessage");
        $this->message = new GcmMessage();
    }

    public function testSetTokensMoreThanOneThousand()
    {
        $this->setExpectedException('RuntimeException');

        $values = array();

        for ($i=0; $i < 1001; $i++) {
            $values[] = 'token_'.$i;
        }

        $this->message->setTokens($values);
    }

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

    public function testSetCollapseKey()
    {
        $value = 'my collapse key';

        $this->message->setCollapseKey($value);

        $property = $this->reflectedClass->getProperty('collapse_key');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetCollapseKey()
    {
        $value = 'my collapse key';

        $property = $this->reflectedClass->getProperty('collapse_key');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getCollapseKey() == $value);
    }

    public function testSetPriorityWrongValue()
    {
        $this->setExpectedException('RuntimeException');

        $this->message->setPriority('my_priority');
    }

    public function testSetPriorityHigh()
    {
        $value = 'high';

        $this->message->setPriority($value);

        $property = $this->reflectedClass->getProperty('priority');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testSetPriorityNormal()
    {
        $value = 'normal';

        $this->message->setPriority($value);

        $property = $this->reflectedClass->getProperty('priority');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetPriority()
    {
        $value = 'normal';

        $property = $this->reflectedClass->getProperty('priority');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getPriority() == $value);
    }

    public function testSetContentAvailable()
    {
        $value = 'my content available';

        $this->message->setContentAvailable($value);

        $property = $this->reflectedClass->getProperty('content_available');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetContentAvailable()
    {
        $value = 'my content available';

        $property = $this->reflectedClass->getProperty('content_available');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getContentAvailable();

        $this->assertTrue(is_bool($valueByReflection) && ($valueByReflection == $value));
    }

    public function testSetDelayWhileIdle()
    {
        $value = 'my delay while idle';

        $this->message->setDelayWhileIdle($value);

        $property = $this->reflectedClass->getProperty('delay_while_idle');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetDelayWhileIdle()
    {
        $value = 'my delay while idle';

        $property = $this->reflectedClass->getProperty('delay_while_idle');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getDelayWhileIdle();

        $this->assertTrue(is_bool($valueByReflection) && ($valueByReflection == $value));
    }

    public function testSetTimeToLive()
    {
        $value = 'my time to live';

        $this->message->setTimeToLive($value);

        $property = $this->reflectedClass->getProperty('time_to_live');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetTimeToLive()
    {
        $value = 'my time to live';

        $property = $this->reflectedClass->getProperty('time_to_live');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $valueByReflection = $this->message->getTimeToLive();

        $this->assertTrue(is_int($valueByReflection) && ($valueByReflection == $value));
    }

    public function testSetRestrictedPackageName()
    {
        $value = 'my restricted package name';

        $this->message->setRestrictedPackageName($value);

        $property = $this->reflectedClass->getProperty('restricted_package_name');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetRestrictedPackageName()
    {
        $value = 'my restricted package name';

        $property = $this->reflectedClass->getProperty('restricted_package_name');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getRestrictedPackageName() == $value);
    }

    public function testSetDryRun()
    {
        $value = true;

        $this->message->setDryRun($value);

        $property = $this->reflectedClass->getProperty('dry_run');
        $property->setAccessible(true);

        $valueByReflection = $property->getValue($this->message);

        $this->assertTrue(is_bool($valueByReflection) && ($valueByReflection == $value));
    }

    public function testGetDryRun()
    {
        $value = 'my dry run';

        $property = $this->reflectedClass->getProperty('dry_run');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getDryRun() == $value);
    }

    public function testSetData()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $this->message->setData($values);

        $property = $this->reflectedClass->getProperty('data');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

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

    public function testSetNotificationTitle()
    {
        $value = 'my notification title';

        $this->message->setNotificationTitle($value);

        $property = $this->reflectedClass->getProperty('notification_title');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationTitle()
    {
        $value = 'my notification title';

        $property = $this->reflectedClass->getProperty('notification_title');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationTitle() == $value);
    }

    public function testSetNotificationBody()
    {
        $value = 'my notification body';

        $this->message->setNotificationBody($value);

        $property = $this->reflectedClass->getProperty('notification_body');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationBody()
    {
        $value = 'my notification body';

        $property = $this->reflectedClass->getProperty('notification_body');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationBody() == $value);
    }

    public function testSetNotificationIcon()
    {
        $value = 'my notification icon';

        $this->message->setNotificationIcon($value);

        $property = $this->reflectedClass->getProperty('notification_icon');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationIcon()
    {
        $value = 'my notification icon';

        $property = $this->reflectedClass->getProperty('notification_icon');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationIcon() == $value);
    }

    public function testSetNotificationSound()
    {
        $value = 'my notification sound';

        $this->message->setNotificationSound($value);

        $property = $this->reflectedClass->getProperty('notification_sound');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationSound()
    {
        $value = 'my notification sound';

        $property = $this->reflectedClass->getProperty('notification_sound');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationSound() == $value);
    }

    public function testSetNotificationBadge()
    {
        $value = 'my notification badge';

        $this->message->setNotificationBadge($value);

        $property = $this->reflectedClass->getProperty('notification_badge');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationBadge()
    {
        $value = 'my notification badge';

        $property = $this->reflectedClass->getProperty('notification_badge');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationBadge() == $value);
    }

    public function testSetNotificationTag()
    {
        $value = 'my notification tag';

        $this->message->setNotificationTag($value);

        $property = $this->reflectedClass->getProperty('notification_tag');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationTag()
    {
        $value = 'my notification tag';

        $property = $this->reflectedClass->getProperty('notification_tag');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationTag() == $value);
    }

    public function testSetNotificationColor()
    {
        $value = 'my notification color';

        $this->message->setNotificationColor($value);

        $property = $this->reflectedClass->getProperty('notification_color');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationColor()
    {
        $value = 'my notification color';

        $property = $this->reflectedClass->getProperty('notification_color');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationColor() == $value);
    }

    public function testSetNotificationClickAction()
    {
        $value = 'notification click action';

        $this->message->setNotificationClickAction($value);

        $property = $this->reflectedClass->getProperty('notification_click_action');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationClickAction()
    {
        $value = 'notification click action';

        $property = $this->reflectedClass->getProperty('notification_click_action');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationClickAction() == $value);
    }

    public function testSetNotificationBodyLocKey()
    {
        $value = 'notification body loc key';

        $this->message->setNotificationBodyLocKey($value);

        $property = $this->reflectedClass->getProperty('notification_body_loc_key');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationBodyLocKey()
    {
        $value = 'notification body loc key';

        $property = $this->reflectedClass->getProperty('notification_body_loc_key');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationBodyLocKey() == $value);
    }

    public function testSetNotificationBodyLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $this->message->setNotificationBodyLocArgs($values);

        $property = $this->reflectedClass->getProperty('notification_body_loc_args');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    public function testGetNotificationBodyLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $property = $this->reflectedClass->getProperty('notification_body_loc_args');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getNotificationBodyLocArgs() == $values);
    }

    public function testSetNotificationTitleLocKey()
    {
        $value = 'my notification title loc key';

        $this->message->setNotificationTitleLocKey($value);

        $property = $this->reflectedClass->getProperty('notification_title_loc_key');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetNotificationTitleLocKey()
    {
        $value = 'my notification title loc key';

        $property = $this->reflectedClass->getProperty('notification_title_loc_key');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getNotificationTitleLocKey() == $value);
    }

    public function testSetNotificationTitleLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $this->message->setNotificationTitleLocArgs($values);

        $property = $this->reflectedClass->getProperty('notification_title_loc_args');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    public function testGetNotificationTitleLocArgs()
    {
        $values = array(
            'value1',
            'value2',
            'value3',
        );

        $property = $this->reflectedClass->getProperty('notification_title_loc_args');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getNotificationTitleLocArgs() == $values);
    }
}
