# DreamRobot
DreamRobot PHP SDK


## How to use

```php
<?php

use TimoPaul\DreamRobot\Client\Curl as CurlClient;
use TimoPaul\DreamRobot\Request\ReadPortalAccountsRequest;

$client = CurlClient::getInstance($user, $pass);
$request = $client->createRequest(ReadPortalAccountsRequest::class);
$response = $client->request($request);

```
