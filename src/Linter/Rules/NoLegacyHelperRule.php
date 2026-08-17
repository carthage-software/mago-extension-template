<?php

declare(strict_types=1);

namespace Acme\Mago\Linter\Rules;

use Mago\Sdk\Linter\LintContext;
use Mago\Sdk\Linter\Rule;
use Mago\Sdk\Linter\RuleDefinition;
use Mago\Sdk\Reporting\Issue;
use Mago\Sdk\Reporting\Level;
use Mago\Sdk\Reporting\TextEdit;
use Mago\Sdk\Syntax\NodeKind;

use function strcasecmp;

/**
 * Demonstrates a syntax-targeted rule using resolved names and a precise edit.
 *
 * Replace this example with a convention owned by your project or framework.
 *
 * @internal
 */
final class NoLegacyHelperRule implements Rule
{
    public function getDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            code: 'acme/no-legacy-helper',
            name: 'No legacy helper',
            description: 'Replaces the legacy Acme value helper with its supported equivalent.',
            defaultLevel: Level::Warning,
            defaultEnabled: true,
            targets: [NodeKind::FunctionCall],
        );
    }

    public function lint(LintContext $context): void
    {
        $resolved = $context->getResolvedName();
        if ($resolved === null || strcasecmp($resolved->name, 'Acme\\Legacy\\value') !== 0) {
            return;
        }

        $context->report(Issue::new(
            'Use Acme\\Support\\value() instead of the legacy helper.',
            $context->node->span,
        )->withHelp('Replace the helper while preserving its existing arguments.')->withEdit(TextEdit::replace(
            $resolved->span,
            '\\Acme\\Support\\value',
        )));
    }
}
