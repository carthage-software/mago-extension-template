<?php

declare(strict_types=1);

namespace Acme\Mago\Analyzer\Providers;

use Mago\Sdk\Analyzer\MethodReturnTypeProvider;
use Mago\Sdk\Analyzer\MethodTarget;
use Mago\Sdk\Analyzer\ReturnTypeProviderContext;
use Mago\Sdk\Analyzer\Type;

/**
 * Demonstrates a return type derived from a literal service identifier.
 *
 * Replace these fixture symbols with targets and results from your framework.
 *
 * @internal
 */
final class ContainerReturnTypeProvider implements MethodReturnTypeProvider
{
    private const CONTAINER = 'Acme\\Demo\\Container';
    private const CLOCK = 'Acme\\Demo\\Clock';

    public function getTargets(): array
    {
        return [MethodTarget::exact(self::CONTAINER, 'get')];
    }

    public function getReturnType(ReturnTypeProviderContext $context): ?Type
    {
        $identifier = $context->invocation->getArgument(0, '$id')?->type?->getLiteralString();
        if ($identifier !== 'clock') {
            return null;
        }

        return Type::namedObject(self::CLOCK);
    }
}
