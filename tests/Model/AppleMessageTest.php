<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Model;

use LinkValue\MobileNotif\Model\AppleMessage;

include_once __DIR__.'/MessageTest.php';

/**
 * AppleMessageTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class AppleMessageTest extends MessageTest
{
    protected function setUp()
    {
        $this->reflectedClass = new \ReflectionClass("LinkValue\MobileNotif\Model\AppleMessage");
        $this->message = new AppleMessage();
    }

    public function testSetAlertTitle()
    {
        $value = 'my title';

        $this->message->setAlertTitle($value);

        $property = $this->reflectedClass->getProperty('alert_title');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetAlertTitle()
    {
        $value = 'my title';

        $property = $this->reflectedClass->getProperty('alert_title');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertTitle() == $value);
    }

    public function testSetAlertBody()
    {
        $value = 'my body';

        $this->message->setAlertBody($value);

        $property = $this->reflectedClass->getProperty('alert_body');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetAlertBody()
    {
        $value = 'my body';

        $property = $this->reflectedClass->getProperty('alert_body');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertBody() == $value);
    }

    public function testSetAlertTitleLocKey()
    {
        $value = 'my title loc key';

        $this->message->setAlertTitleLocKey($value);

        $property = $this->reflectedClass->getProperty('alert_title_loc_key');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetAlertTitleLocKey()
    {
        $value = 'my title loc key';

        $property = $this->reflectedClass->getProperty('alert_title_loc_key');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertTitleLocKey() == $value);
    }

    public function testSetAlertTitleLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $this->message->setAlertTitleLocArgs($values);

        $property = $this->reflectedClass->getProperty('alert_title_loc_args');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    public function testGetAlertTitleLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $property = $this->reflectedClass->getProperty('alert_title_loc_args');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getAlertTitleLocArgs() == $values);
    }

    public function testSetAlertActionLocKey()
    {
        $value = 'my action loc key';

        $this->message->setAlertActionLocKey($value);

        $property = $this->reflectedClass->getProperty('alert_action_loc_key');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetAlertActionLocKey()
    {
        $value = 'my action loc key';

        $property = $this->reflectedClass->getProperty('alert_action_loc_key');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertActionLocKey() == $value);
    }

    public function testSetAlertLocKey()
    {
        $value = 'my loc key';

        $this->message->setAlertLocKey($value);

        $property = $this->reflectedClass->getProperty('alert_loc_key');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetAlertLocKey()
    {
        $value = 'my loc key';

        $property = $this->reflectedClass->getProperty('alert_loc_key');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertLocKey() == $value);
    }

    public function testSetAlertLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $this->message->setAlertLocArgs($values);

        $property = $this->reflectedClass->getProperty('alert_loc_args');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    public function testGetAlertLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $property = $this->reflectedClass->getProperty('alert_loc_args');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getAlertLocArgs() == $values);
    }

    public function testSetAlertLaunchImage()
    {
        $value = 'my launch image';

        $this->message->setAlertLaunchImage($value);

        $property = $this->reflectedClass->getProperty('alert_launch_image');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetAlertLaunchImage()
    {
        $value = 'my launch image';

        $property = $this->reflectedClass->getProperty('alert_launch_image');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertLaunchImage() == $value);
    }

    public function testSetBadge()
    {
        $value = 'my badge';

        $this->message->setBadge($value);

        $property = $this->reflectedClass->getProperty('badge');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetBadge()
    {
        $value = 'my badge';

        $property = $this->reflectedClass->getProperty('badge');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getBadge() == $value);
    }

    public function testSetSound()
    {
        $value = 'my sound';

        $this->message->setSound($value);

        $property = $this->reflectedClass->getProperty('sound');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetSound()
    {
        $value = 'my sound';

        $property = $this->reflectedClass->getProperty('sound');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getSound() == $value);
    }

    public function testGetSoundDefaultValue()
    {
        $this->assertTrue($this->message->getSound() == 'default');
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

        $this->assertTrue($this->message->getContentAvailable() == $value);
    }

    public function testSetCategory()
    {
        $value = 'my category';

        $this->message->setCategory($value);

        $property = $this->reflectedClass->getProperty('category');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    public function testGetCategory()
    {
        $value = 'my category';

        $property = $this->reflectedClass->getProperty('category');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getCategory() == $value);
    }

    public function testSetData()
    {
        $values = array(
            'data1' => 'value1',
            'data2' => 'value2',
            'data3' => array(
                'value3_1',
                'value3_2',
            ),
            'data4' => array(
                'data4_1' => 'value4_1',
                'data4_2' => 'value4_2',
            ),
        );

        $this->message->setData($values);

        $property = $this->reflectedClass->getProperty('data');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    public function testGetData()
    {
        $values = array(
            'data1' => 'value1',
            'data2' => 'value2',
            'data3' => array(
                'value3_1',
                'value3_2',
            ),
            'data4' => array(
                'data4_1' => 'value4_1',
                'data4_2' => 'value4_2',
            ),
        );

        $property = $this->reflectedClass->getProperty('data');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getData() == $values);
    }

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

    public function testSetDataWithApsKey()
    {
        $this->setExpectedException('RuntimeException');

        $values = array(
            'data1' => 'value1',
            'aps' => array(
                'value3_1',
                'value3_2',
            ),
        );

        $this->message->setData($values);
    }

    public function testaddDataWithApsKey()
    {
        $this->setExpectedException('RuntimeException');

        $key1 = 'aps';
        $value1 = 'value1';

        $this->message->addData($key1, $value1);
    }

    public function testConstructor()
    {
        $properties = array(
            'alert_title_loc_args',
            'alert_loc_args',
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

    public function testGetPayload()
    {
    }
}
