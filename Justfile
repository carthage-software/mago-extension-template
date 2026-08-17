set dotenv-load := false

mago := "vendor/bin/mago"

validate:
    composer validate --strict --no-check-publish

test:
    vendor/bin/phpunit --configuration phpunit.xml

lint:
    {{mago}} --config mago.toml lint

analyze:
    {{mago}} --config mago.toml analyze

format:
    {{mago}} --config mago.toml format

format-check:
    {{mago}} --config mago.toml format --check

test-corpus:
    {{mago}} --workspace tests/corpus lint --only acme/no-legacy-helper --reporting-format count
    {{mago}} --workspace tests/corpus analyze --reporting-format count

check: validate format-check test lint analyze test-corpus

