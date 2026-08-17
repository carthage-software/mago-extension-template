<?php

declare(strict_types=1);

namespace Acme\Mago\Tests;

use Acme\Mago\AcmeExtension;
use PHPUnit\Framework\TestCase;

final class AcmeExtensionTest extends TestCase
{
    public function testFactoryOwnsStableRegistration(): void
    {
        $extension = AcmeExtension::create();

        self::assertSame('acme/mago-extension', $extension->identifier);
        self::assertSame('Acme Mago Extension', $extension->name);
        self::assertSame('0.1.0', $extension->version);
        self::assertCount(1, $extension->linterRules);
        self::assertCount(1, $extension->analyzerPlugins);
        self::assertNull($extension->workerReducer);
    }
}
