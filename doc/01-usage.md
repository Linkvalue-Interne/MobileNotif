#Usage

###Simple use

```
<?php

require "../vendor/autoload.php";

use LinkValue\MobileNotif\Model\Message;
use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Client\AppleClient;

//create the message to push
$message = new Message();
$message
	->setNotificationTitle('This is the message title')
	->setNotificationBody('This is the message body');

//push notification to android device
$gcmClient = new GcmClient('API ACCEESS KEY');
$gcmClient->push($message);

//push notification to apple device
$appleclient = new AppleClient(__DIR__.'/data/myssl.pem', 'my_passphrase');
$appleclient->push($message);

```

###Complete use

```
<?php

require "../vendor/autoload.php";

use LinkValue\MobileNotif\Client\AppleClient;
use LinkValue\MobileNotif\Model\AppleMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



//create the message to push
$message = new Message();
$message
	->setNotificationTitle('This is the message title')
	->setNotificationBody('This is the message body')
	->addToken('TOKEN 1')
	->addToken('TOKEN 2')
	//set apple specifics attributes (ignored for gcmClients)
	->setData(array('myKey' => 'myValue'))
	//set android specifics attributes (ignored for appleClients)
	->setCollapseKey('myCollapseKey')

//create logger
$logger = new Logger('notif');
$logger->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

//push notification to android device with logger
$gcmClient = new GcmClient('API ACCEESS KEY', 'https://mypersonnalEndPoint');
$gcmClient->setLogger($logger);
$gcmClient->push($message);

//push notification to apple device with logger
$appleclient = new AppleClient(__DIR__.'/data/myssl.pem', 'my_passphrase', 'https://mypersonnalEndPoint');
$appleclient->setLogger($log);
$appleclient->push($message);
```
