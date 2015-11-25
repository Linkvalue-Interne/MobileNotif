#Usage

###Google Cloud Messaging

```
<?php

require "../vendor/autoload.php";

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('notif');
$log->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

$client = new GcmClient($log);
$client->setUp(array(
    'endpoint' => 'https://android.googleapis.com/gcm/send',
    'api_access_key' => 'API ACCEESS KEY',
));

$message = new GcmMessage();
$message->addToken('THE TOKEN HERE');
$message->setNotificationTitle('This is the message title');
$message->setNotificationBody('This is the message body');

$client->push($message);

```

###Apple Push Notification Server

```
<?php

require "../vendor/autoload.php";

use LinkValue\MobileNotif\Client\AppleClient;
use LinkValue\MobileNotif\Model\AppleMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('notif');
$log->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

$client = new AppleClient($log);
$client->setUp(array(
    'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
    'ssl_pem_path' => __DIR__.'/data/myssl.pem',
    'ssl_passphrase' => 'my_passphrase',
));

$message = new AppleMessage();
$message->addToken('THE TOKEN HERE');
$message->setAlertTitle('This is the message title');
$message->setAlertBody('This is the message body');

$client->push($message);
```
