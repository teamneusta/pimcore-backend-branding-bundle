<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Css;

final class CssRuleList
{
    /** @var list<CssRule> */
    private array $rules = [];

    public function addRule(CssRule $rule): void
    {
        $this->rules[] = $rule;
    }

    public function toString(): string
    {
        return implode("\n", array_map(strval(...), $this->rules));
    }
}
