<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\Css;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class CssRuleListTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @test
     */
    public function it_contains_a_bunch_of_rules(): void
    {
        $ruleList = new CssRuleList();

        $ruleList->addRule(new CssRule('#some-rule',
            new CssProperty('color', 'blue'),
            new CssProperty('margin', '0'),
            new CssProperty('display', 'block'),
        ));

        $ruleList->addRule(new CssRule('.another-rule',
            new CssProperty('background-image', 'image.jpg', isUrl: true),
            new CssProperty('padding', '0'),
        ));

        $ruleList->addRule(new CssRule('.some.specific .rule',
            new CssProperty('border', '5px solid black', isImportant: true),
        ));

        $this->assertMatchesTextSnapshot($ruleList->toString());
    }
}
