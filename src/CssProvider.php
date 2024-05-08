<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;

final class CssProvider
{
    /**
     * @param iterable<callable():iterable<CssRule>> $providers
     */
    public function __construct(
        private readonly iterable $providers,
    ) {
    }

    public function getRules(): CssRuleList
    {
        $css = new CssRuleList();

        foreach ($this->providers as $provider) {
            foreach ($provider() as $rule) {
                $css->addRule($rule);
            }
        }

        return $css;
    }
}
