# Mago Extension Template

A small, end-to-end template for building external linter rules and analyzer plugins for [Mago](https://github.com/carthage-software/mago).

The example extension contains:

- a linter rule selected by an exact syntax-node kind;
- a machine-applicable edit based on Mago's resolved names;
- an analyzer plugin with a targeted method return-type provider;
- unit tests and a real Mago corpus test using an external worker;
- formatting, linting, analysis, and CI commands.

## Start a new extension

Create a repository from this template, then replace the example identity before writing new capabilities:

1. Rename `acme/mago-extension` in `composer.json`.
2. Replace the `Acme\Mago` namespace and PSR-4 mappings.
3. Rename `AcmeExtension` and update its identifier, name, and version.
4. Rename the analyzer plugin identifier and every linter issue code.
5. Replace or remove the example rule, provider, fixtures, and corpus expectations.
6. Set the package author, description, keywords, and license.

Keep the package-owned extension factory as the only registration API consumers need. Typed factory arguments may expose intentional options, but consumers should not have to reconstruct rule and plugin lists themselves.

## Package structure

```text
src/
├── AcmeExtension.php
├── Analyzer/
│   ├── AcmePlugin.php
│   └── Providers/
│       └── ContainerReturnTypeProvider.php
└── Linter/
    └── Rules/
        └── NoLegacyHelperRule.php
tests/
├── Unit/
└── corpus/
    ├── mago.toml
    ├── worker.php
    └── src/
```

Put lifecycle callbacks under `src/Analyzer/Hooks/`, semantic providers under `src/Analyzer/Providers/`, linter rules under `src/Linter/Rules/`, and worker reducers under `src/Worker/`.

## Install the extension

Applications install Mago and the finished extension together:

```shell
composer require --dev carthage-software/mago acme/mago-extension
```

The application owns its worker entrypoint. Create `.mago/extensions.php`:

```php
<?php

declare(strict_types=1);

use Acme\Mago\AcmeExtension;
use Mago\Sdk\Worker;

require dirname(__DIR__) . '/vendor/autoload.php';

new Worker(AcmeExtension::create())->run();
```

Register it in `mago.toml`:

```toml
[extension-hosts.acme]
command = ["php", ".mago/extensions.php"]
```

Several extension factories may be passed to the same `Worker`. Standard output is reserved for protocol frames; write development diagnostics to standard error.

## Development

Install dependencies and run every check:

```shell
composer install
just check
```

Useful focused commands are:

```shell
just format
just test
just lint
just analyze
just test-corpus
```

The corpus starts the real worker and checks inline `@mago-expect` annotations. Keep small fixtures for positive, negative, and non-matching behavior. A larger extension may use Mago's strict baseline files for a representative fixture project.

Read the [Mago extension documentation](https://mago.carthage.software/main/en/extensions/overview/) for the complete SDK, lifecycle, metadata, reporting, performance, and packaging contracts.

## License

The template uses the MIT License. Replace it if the new package uses another license.
