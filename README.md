# MobileNotif

[![Build Status](https://travis-ci.org/LinkValue/MobileNotif.svg?branch=master)](https://travis-ci.org/LinkValue/MobileNotif)
[![Code Coverage](https://scrutinizer-ci.com/g/LinkValue/MobileNotif/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/LinkValue/MobileNotif/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LinkValue/MobileNotif/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LinkValue/MobileNotif/?branch=master)

PHP library to send notifications to mobile devices.

If you're using [Symfony framework](https://symfony.com/), take a look at [LinkValue/MobileNotifBundle](https://github.com/LinkValue/MobileNotifBundle) to easily manage and profile multiple clients.



## Installation

Using [Composer](https://getcomposer.org/) through `composer.json` file:

```json
"require": {
    "linkvalue/mobile-notif": "^0.2"
}
```

Or using composer CLI:

```bash
composer require linkvalue/mobile-notif
```



## Examples

### Send simple notification using Google Cloud Messaging (aka. GCM)

```php
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;

$client = new GcmClient();
$client->setUp(array(
    'endpoint' => 'https://android.googleapis.com/gcm/send',
    'api_access_key' => 'API ACCESS KEY',
));

$message = new GcmMessage();
$message
    ->addToken('DESTINATION DEVICE TOKEN HERE')
    ->setNotificationTitle('Message title')
    ->setNotificationBody('Message body')
    ->setNotificationIcon('myicon')
;

$client->push($message);
```



### Send simple notification using Apple Push Notification Service (aka. APNS) in development mode

```php
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\ApnsClient;
use LinkValue\MobileNotif\Model\ApnsMessage;

$client = new ApnsClient();
$client->setUp(array(
    'endpoint' => 'tls://gateway.sandbox.push.apple.com:2195',
    'ssl_pem_path' => __DIR__.'/BundleIncludingCertAndPrivateKey-dev.pem',
));

$message = new ApnsMessage();
$message
    ->addToken('DESTINATION DEVICE TOKEN HERE')
    ->setSimpleAlert('Hello World!')
;

$client->push($message);
```



### Send notification using GCM to multiple devices and log everything in a file using [Monolog](https://github.com/Seldaek/monolog) as [Psr/Log](https://github.com/php-fig/log) implementation

```php
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\GcmClient;
use LinkValue\MobileNotif\Model\GcmMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('notif');
$log->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

$client = new GcmClient();
$client
    ->setLogger($log);
    ->setUp(array(
        'endpoint' => 'https://android.googleapis.com/gcm/send',
        'api_access_key' => 'API ACCESS KEY',
    ))
;

$message = new GcmMessage();
$message
    ->addToken('DESTINATION DEVICE TOKEN1 HERE')
    ->addToken('DESTINATION DEVICE TOKEN2 HERE')
    ->setNotificationTitle('Message title')
    ->setNotificationBody('Message body')
    ->setNotificationIcon('myicon')
    ->setNotificationSound('default')
;

$client->push($message);
```



### Send notification using APNS (in production mode) to multiple devices and log everything in a file using [Monolog](https://github.com/Seldaek/monolog) as [Psr/Log](https://github.com/php-fig/log) implementation

```php
<?php

require 'path/to/composer/vendor/autoload.php';

use LinkValue\MobileNotif\Client\ApnsClient;
use LinkValue\MobileNotif\Model\ApnsMessage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('notif');
$log->pushHandler(new StreamHandler(__DIR__.'/notif.log', Logger::INFO));

$client = new ApnsClient();
$client
    ->setLogger($log);
    ->setUp(array(
        'endpoint' => 'tls://gateway.push.apple.com:2195',
        'ssl_pem_path' => __DIR__.'/data/BundleIncludingCertAndPrivateKey-prod.pem',
        'ssl_passphrase' => 'my production PEM file passphrase',
    ))
;

$message = new ApnsMessage();
$message
    ->addToken('DESTINATION DEVICE TOKEN1 HERE')
    ->addToken('DESTINATION DEVICE TOKEN2 HERE')
    ->setAlertTitle('Message title')
    ->setAlertBody('Message body')
    ->setBadge(1)
    ->setSound('default')
;

$client->push($message);
```



## Resources

### APNS

  - [Everything you should know about APNS payload](https://developer.apple.com/library/ios/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/Chapters/TheNotificationPayload.html)



### GCM

  - [Everything you should know about GCM payload](https://developers.google.com/cloud-messaging/http-server-ref)



## Tests

We want this library to be fully covered by unit tests, so if you contribute to this project, be aware that your PR build will fail if the code coverage drops below 100%.

### Running tests with HTML code coverage

```bash
# install dependencies
composer install
mkdir -p wallet

# if xdebug extension is enabled on PHP CLI
vendor/bin/phpunit --coverage-html wallet/coverage

# else if xdebug is installed but not enabled
php -dzend_extension=xdebug.so vendor/bin/phpunit --coverage-html wallet/coverage
```
