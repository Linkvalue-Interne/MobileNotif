<?php

/*
 * This file is part of the MobileNotif package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LinkValue\MobileNotif\tests\Model;

use LinkValue\MobileNotif\Model\ApnsMessage;

/**
 * ApnsMessageTest.
 *
 * @author  Jamal Youssefi <jamal.youssefi@gmail.com>
 * @author  Valentin Coulon <valentin.c0610@gmail.com>
 */
class ApnsMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApnsMessage
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
        $this->reflectedClass = new \ReflectionClass('LinkValue\MobileNotif\Model\ApnsMessage');
        $this->message = new ApnsMessage();
    }

    /**
     * @test
     */
    public function testConstructor()
    {
        $properties = array(
            'alertTitleLocArgs',
            'alertLocArgs',
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
    public function testSetAlertTitle()
    {
        $value = 'my title';

        $this->message->setAlertTitle($value);

        $property = $this->reflectedClass->getProperty('alertTitle');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetAlertTitle()
    {
        $value = 'my title';

        $property = $this->reflectedClass->getProperty('alertTitle');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertTitle() == $value);
    }

    /**
     * @test
     */
    public function testSetAlertBody()
    {
        $value = 'my body';

        $this->message->setAlertBody($value);

        $property = $this->reflectedClass->getProperty('alertBody');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetAlertBody()
    {
        $value = 'my body';

        $property = $this->reflectedClass->getProperty('alertBody');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertBody() == $value);
    }

    /**
     * @test
     */
    public function testSetAlertTitleLocKey()
    {
        $value = 'my title loc key';

        $this->message->setAlertTitleLocKey($value);

        $property = $this->reflectedClass->getProperty('alertTitleLocKey');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetAlertTitleLocKey()
    {
        $value = 'my title loc key';

        $property = $this->reflectedClass->getProperty('alertTitleLocKey');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertTitleLocKey() == $value);
    }

    /**
     * @test
     */
    public function testSetAlertTitleLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $this->message->setAlertTitleLocArgs($values);

        $property = $this->reflectedClass->getProperty('alertTitleLocArgs');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    /**
     * @test
     */
    public function testGetAlertTitleLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $property = $this->reflectedClass->getProperty('alertTitleLocArgs');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getAlertTitleLocArgs() == $values);
    }

    /**
     * @test
     */
    public function testSetAlertActionLocKey()
    {
        $value = 'my action loc key';

        $this->message->setAlertActionLocKey($value);

        $property = $this->reflectedClass->getProperty('alertActionLocKey');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetAlertActionLocKey()
    {
        $value = 'my action loc key';

        $property = $this->reflectedClass->getProperty('alertActionLocKey');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertActionLocKey() == $value);
    }

    /**
     * @test
     */
    public function testSetAlertLocKey()
    {
        $value = 'my loc key';

        $this->message->setAlertLocKey($value);

        $property = $this->reflectedClass->getProperty('alertLocKey');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetAlertLocKey()
    {
        $value = 'my loc key';

        $property = $this->reflectedClass->getProperty('alertLocKey');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertLocKey() == $value);
    }

    /**
     * @test
     */
    public function testSetAlertLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $this->message->setAlertLocArgs($values);

        $property = $this->reflectedClass->getProperty('alertLocArgs');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $values);
    }

    /**
     * @test
     */
    public function testGetAlertLocArgs()
    {
        $values = array(
            'arg1',
            'arg2',
            'arg3',
        );

        $property = $this->reflectedClass->getProperty('alertLocArgs');
        $property->setAccessible(true);
        $property->setValue($this->message, $values);

        $this->assertTrue($this->message->getAlertLocArgs() == $values);
    }

    /**
     * @test
     */
    public function testSetAlertLaunchImage()
    {
        $value = 'my launch image';

        $this->message->setAlertLaunchImage($value);

        $property = $this->reflectedClass->getProperty('alertLaunchImage');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetAlertLaunchImage()
    {
        $value = 'my launch image';

        $property = $this->reflectedClass->getProperty('alertLaunchImage');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getAlertLaunchImage() == $value);
    }

    /**
     * @test
     */
    public function testSetBadge()
    {
        $value = 'my badge';

        $this->message->setBadge($value);

        $property = $this->reflectedClass->getProperty('badge');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetBadge()
    {
        $value = 'my badge';

        $property = $this->reflectedClass->getProperty('badge');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getBadge() == $value);
    }

    /**
     * @test
     */
    public function testSetSound()
    {
        $value = 'my sound';

        $this->message->setSound($value);

        $property = $this->reflectedClass->getProperty('sound');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetSound()
    {
        $value = 'my sound';

        $property = $this->reflectedClass->getProperty('sound');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getSound() == $value);
    }

    /**
     * @test
     */
    public function testGetSoundDefaultValue()
    {
        $this->assertTrue($this->message->getSound() == 'default');
    }

    /**
     * @test
     */
    public function testSetContentAvailable()
    {
        $value = 'my content available';

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
        $value = 'my content available';

        $property = $this->reflectedClass->getProperty('contentAvailable');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getContentAvailable() == $value);
    }

    /**
     * @test
     */
    public function testSetCategory()
    {
        $value = 'my category';

        $this->message->setCategory($value);

        $property = $this->reflectedClass->getProperty('category');
        $property->setAccessible(true);

        $this->assertTrue($property->getValue($this->message) == $value);
    }

    /**
     * @test
     */
    public function testGetCategory()
    {
        $value = 'my category';

        $property = $this->reflectedClass->getProperty('category');
        $property->setAccessible(true);
        $property->setValue($this->message, $value);

        $this->assertTrue($this->message->getCategory() == $value);
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function testAddDataWithApsKey()
    {
        $this->setExpectedException('RuntimeException');

        $key1 = 'aps';
        $value1 = 'value1';

        $this->message->addData($key1, $value1);
    }
}
