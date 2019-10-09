# DreamRobot REST API PHP SDK
This library contains a wrapper for the DreamRobot REST API. It is not fully implemented yet, some record types and functions are missing.

## How to use

```php
<?php

use TimoPaul\DreamRobot\Client\Curl as CurlClient;
use TimoPaul\DreamRobot\Request\ReadPortalAccountsRequest;

$client = CurlClient::getInstance($user, $pass);
$request = $client->createRequest(ReadPortalAccountsRequest::class);
$response = $client->request($request);

```
