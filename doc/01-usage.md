#Usage

##Simple use

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

##Complete use

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

##The differents messages types

###Message
```
$message = new Message();
$message
        ->setNotificationTitle('This is the message title')
        //set apple specifics attributes (ignored for gcmClients)
	->setData(array('myKey' => 'myValue'))
        //set android specifics attributes (ignored for appleClients)
	->setCollapseKey('myCollapseKey')
```

Has seen in the example, the Message is the more global model that can take all parameters for both Apple and Gcm message.
This even include specifics parameters (like data for apple or collapseKey for gcm).
So, if a message with gcm-only parameters is given to an AppleClient, the gcm parameters will be ignored.
It is usefull when you need to manage both client type with specifics message parameters of each one.

#AppleMessage and GcmMessage
```
$appleMessage = new AppleMessage();
$appleMessage
        ->setNotificationTitle('This is the message title')
	->setData(array('myKey' => 'myValue'))

$gcmMessage = new GcmMessage();
$gcmMessage
        ->setNotificationTitle('This is the message title')
	->setCollapseKey('myCollapseKey')
```
This Messages type have the same functionnalities than the global Message, but they are specifics to there respectives client.
They will only take parameters that the client can understand.
They are usefull if you only need one type of Client or if you want manage Apple and Gcm client separatly.


#SimpleMessage
```
$message = new SimpleMessage();
$message
        ->setNotificationTitle('This is the message title')
```
The SimpleMessage can only manage parameters that can be used by both Apple and Gcm client.
No specifics parameters can be provided.
It can be usefull when you want to send the same message to each type of client, without being flooded by all the specifics parameters.
