<?php

namespace Phpfastcache\Extensions\Drivers\Dynamodb;

class Event extends \Phpfastcache\Event\Event
{
    public const DYNAMODB_CREATE_TABLE = 'DynamodbCreateTable';
}
