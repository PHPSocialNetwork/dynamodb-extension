<?php

declare(strict_types=1);

namespace Phpfastcache;

use Phpfastcache\Extensions\Drivers\Dynamodb\{Config, Event, Driver, Item};

// Semver Compatibility until v10
class_alias(Config::class, Drivers\Dynamodb\Config::class);
class_alias(Driver::class, Drivers\Dynamodb\Driver::class);
class_alias(Event::class, Drivers\Dynamodb\Event::class);
class_alias(Item::class, Drivers\Dynamodb\Item::class);

ExtensionManager::registerExtension('Dynamodb', Driver::class);
