<?php

declare(strict_types=1);

namespace Acme\Demo;

interface Container
{
    public function get(string $id): object;
}

final class Clock {}

function accepts_clock(Clock $_clock): void {}

function use_container(Container $container): void
{
    accepts_clock($container->get('clock'));
}

