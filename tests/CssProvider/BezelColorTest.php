<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;
use Neusta\Pimcore\BackendBrandingBundle\CssProvider\BezelColor;
use Neusta\Pimcore\BackendBrandingBundle\Settings;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class BezelColorTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @test
     */
    public function it_is_empty_when_not_configured(): void
    {
        $settings = new Settings();
        $bezelColor = new BezelColor($settings);
        $ruleList = new CssRuleList();

        $ruleList->addRules($bezelColor->__invoke());

        self::assertEmpty($ruleList->toString());
    }

    /**
     * @test
     */
    public function it_contains_rules_when_configured(): void
    {
        $settings = new Settings();
        $bezelColor = new BezelColor($settings);
        $ruleList = new CssRuleList();

        $settings->bezelColor = '#000';
        $ruleList->addRules($bezelColor->__invoke());

        $this->assertMatchesTextSnapshot($ruleList->toString());
    }
}
