<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\CssProvider;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;
use Neusta\Pimcore\BackendBrandingBundle\CssProvider\TabBarIcon;
use Neusta\Pimcore\BackendBrandingBundle\Settings;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class TabBarIconTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @test
     */
    public function it_is_empty_when_not_configured(): void
    {
        $settings = new Settings();
        $bezelColor = new TabBarIcon($settings);
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
        $bezelColor = new TabBarIcon($settings);
        $ruleList = new CssRuleList();

        $ruleList->addRules($bezelColor->__invoke());

        $this->assertMatchesTextSnapshot($ruleList->toString());
    }

    public function configProvider(): iterable
    {
        yield 'minimal settings' => [$this->createSettings(
            url: 'icon.png',
        )];

        yield 'with size' => [$this->createSettings(
            url: 'icon.png',
            size: '90%',
        )];

        yield 'with position' => [$this->createSettings(
            url: 'icon.jpg',
            position: 'center',
        )];

        yield 'with size and position' => [$this->createSettings(
            url: 'icon.gif',
            size: '70%',
            position: 'right',
        )];
    }

    private function createSettings(string ...$params): Settings
    {
        $settings = new Settings();
        $tabBarIcon = new Settings\TabBarIcon();

        foreach ($params as $name => $value) {
            $tabBarIcon->{$name} = $value;
        }

        $settings->tabBarIcon = $tabBarIcon;

        return $settings;
    }
}
