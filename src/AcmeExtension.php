<?php

declare(strict_types=1);

namespace Acme\Mago;

use Acme\Mago\Analyzer\AcmePlugin;
use Acme\Mago\Linter\Rules\NoLegacyHelperRule;
use Mago\Sdk\Extension;

/**
 * Constructs the complete extension advertised by each worker process.
 *
 * @api
 */
final class AcmeExtension
{
    private const VERSION = '0.1.0';

    private function __construct() {}

    public static function create(): Extension
    {
        return new Extension(
            identifier: 'acme/mago-extension',
            name: 'Acme Mago Extension',
            version: self::VERSION,
            linterRules: [new NoLegacyHelperRule()],
            analyzerPlugins: [new AcmePlugin()],
        );
    }
}
