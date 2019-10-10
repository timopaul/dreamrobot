# DreamRobot REST API PHP SDK

[DreamRobot on Packagist](https://packagist.org/packages/timopaul/dreamrobot)

This library contains a wrapper for the DreamRobot REST API. It is not fully implemented yet, some record types and functions are missing.

Please create a pull request if you have implemented a new API request or create issues for bugs/feature requests.

## How to use

```php
<?php

use TimoPaul\DreamRobot\Client\Curl as CurlClient;
use TimoPaul\DreamRobot\Request\ReadPortalAccountsRequest;

// initialize HTTP client
$client = CurlClient::getInstance($user, $pass);

// create request object
$request = $client->createRequest(ReadPortalAccountsRequest::class);

// send HTTP request and get response object
$response = $client->send($request);

```

## Supported Requests

- `GET system/payment_method/`
- `GET admin/portal_account/`
- `POST token.php`
- `POST order/`


## Installation

Using Composer, just add it to your `composer.json` by running:

```shell
composer require timopaul/dreamrobot
```


## DreamRobot API Documentation

<https://www.dreamrobot.de/rest/Doku/doku.php>
