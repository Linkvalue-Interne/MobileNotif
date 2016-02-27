# MobileNotif

PHP library to send notifications to mobile devices.

If you're using [Symfony framework](https://symfony.com/), take a look at [LinkValue/MobileNotifBundle](https://github.com/LinkValue/MobileNotifBundle) to easily manage and profile multiple clients.



## Installation

Using [Composer](https://getcomposer.org/):

```
# composer.json

"require": {
    "linkvalue/mobile-notif": "^0.1"
}
```



## Examples

### Send notification using Google Cloud Messaging (aka. GCM)

```
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;

$client = new GcmClient();
$client->setUp(array(
    'endpoint' => 'https://android.googleapis.com/gcm/send',
    'api_access_key' => 'API ACCEESS KEY',
));

$message = new GcmMessage();
$message->addToken('DESTINATION DEVICE TOKEN HERE');
$message->setNotificationTitle('Message title');
$message->setNotificationBody('Message body');

$client->push($message);
```



### Send notification using Apple Push Notification Service (aka. APNS)

```
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\ApnsClient;
use LinkValue\MobileNotif\Model\ApnsMessage;

$client = new ApnsClient();
$client->setUp(array(
    'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195', // Endpoint for development mode. If you want the production mode, just remove ".sandbox".
    'ssl_pem_path' => __DIR__.'/data/BundleIncludingCertAndPrivateKey-dev.pem', // The PEM certificate bundle used depends on development/production mode.
    'ssl_passphrase' => 'my_passphrase', // The passphrase for the PEM certificate bundle (if needed).
));

$message = new ApnsMessage();
$message->addToken('DESTINATION DEVICE TOKEN HERE');
$message->setAlertTitle('Message title');
$message->setAlertBody('Message body');

$client->push($message);
```



### Send notification using GCM to multiple devices and log everything in a file using [Monolog](https://github.com/Seldaek/monolog) as [Psr/Log](https://github.com/php-fig/log) implementation

```
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('notif');
$log->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

$client = new GcmClient();
$client->setLogger($log);
$client->setUp(array(
    'endpoint' => 'https://android.googleapis.com/gcm/send',
    'api_access_key' => 'API ACCEESS KEY',
));

$message = new GcmMessage();
$message->addToken('DESTINATION DEVICE TOKEN1 HERE');
$message->addToken('DESTINATION DEVICE TOKEN2 HERE');
$message->setNotificationTitle('Message title');
$message->setNotificationBody('Message body');

$client->push($message);
```



### Send notification using APNS to multiple devices and log everything in a file using [Monolog](https://github.com/Seldaek/monolog) as [Psr/Log](https://github.com/php-fig/log) implementation

```
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\ApnsClient;
use LinkValue\MobileNotif\Model\ApnsMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('notif');
$log->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

$client = new ApnsClient();
$client->setLogger($log);
$client->setUp(array(
    'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195', // Endpoint for development mode. If you want the production mode, just remove ".sandbox".
    'ssl_pem_path' => __DIR__.'/data/BundleIncludingCertAndPrivateKey-dev.pem', // The PEM certificate bundle used depends on development/production mode.
    'ssl_passphrase' => 'my_passphrase', // The passphrase for the PEM certificate bundle (if needed).
));

$message = new ApnsMessage();
$message->addToken('DESTINATION DEVICE TOKEN1 HERE');
$message->addToken('DESTINATION DEVICE TOKEN2 HERE');
$message->setAlertTitle('Message title');
$message->setAlertBody('Message body');

$client->push($message);
```
