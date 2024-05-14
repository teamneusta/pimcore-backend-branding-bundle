<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;
use Neusta\Pimcore\BackendBrandingBundle\CssProvider\Signet;
use Neusta\Pimcore\BackendBrandingBundle\Settings;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class SignetTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @test
     */
    public function it_is_empty_when_not_configured(): void
    {
        $settings = new Settings();
        $bezelColor = new Signet($settings);
        $ruleList = new CssRuleList();

        $ruleList->addRules($bezelColor->__invoke());

        self::assertEmpty($ruleList->toString());
    }

    /**
     * @test
     *
     * @dataProvider configProvider
     */
    public function it_contains_rules_when_configured(Settings $settings): void
    {
        $bezelColor = new Signet($settings);
        $ruleList = new CssRuleList();

        $ruleList->addRules($bezelColor->__invoke());

        $this->assertMatchesTextSnapshot($ruleList->toString());
    }

    public function configProvider(): iterable
    {
        yield 'minimal settings' => [$this->createSettings(
            url: 'signet.png',
            size: '70%',
            position: 'center',
        )];

        yield 'with color' => [$this->createSettings(
            url: 'signet.jpg',
            size: '50%',
            position: 'left',
            color: '#f00',
        )];
    }

    private function createSettings(string ...$params): Settings
    {
        $settings = new Settings();
        $signet = new Settings\Signet();

        foreach ($params as $name => $value) {
            $signet->{$name} = $value;
        }

        $settings->signet = $signet;

        return $settings;
    }
}
