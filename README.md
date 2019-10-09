# DreamRobot REST API PHP SDK
This library contains a wrapper for the DreamRobot REST API. It is not fully implemented yet, some record types and functions are missing.

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
