<?php

declare(strict_types=1);

namespace Acme\Demo;

use function Acme\Legacy\value;

// @mago-expect lint:acme/no-legacy-helper
value('example');

