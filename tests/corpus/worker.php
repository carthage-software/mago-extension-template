<?php

declare(strict_types=1);

use Acme\Mago\AcmeExtension;
use Mago\Sdk\Worker;

require dirname(__DIR__, 2) . '/vendor/autoload.php';

(new Worker(AcmeExtension::create()))->run();
