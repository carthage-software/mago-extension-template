<?php

declare(strict_types=1);

namespace Acme\Mago\Analyzer;

use Acme\Mago\Analyzer\Providers\ContainerReturnTypeProvider;
use Mago\Sdk\Analyzer\Plugin;
use Mago\Sdk\Analyzer\PluginDefinition;
use Mago\Sdk\Analyzer\PluginRegistry;

/**
 * @internal
 */
final class AcmePlugin implements Plugin
{
    public function getDefinition(): PluginDefinition
    {
        return new PluginDefinition(
            identifier: 'acme/framework',
            name: 'Acme Framework',
            description: 'Understands Acme framework conventions.',
        );
    }

    public function register(PluginRegistry $registry): void
    {
        $registry->enableProviderMemoization();
        $registry->registerMethodReturnTypeProvider(new ContainerReturnTypeProvider());
    }
}
