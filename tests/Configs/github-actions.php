<?php

use Phpfastcache\Drivers\Dynamodb\Config as DynamodbConfig;

return (new DynamodbConfig())
    ->setRegion('eu-west-3')
    ->setEndpoint('dynamodb.eu-west-3.amazonaws.com')
    ->setTable('phpfastcache');
