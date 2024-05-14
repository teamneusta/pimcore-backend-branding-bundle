<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\Css;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class CssRuleTest extends TestCase
{
    use MatchesSnapshots;

    /**
     * @test
     */
    public function it_is_a_selector_with_properties(): void
    {
        $this->assertMatchesTextSnapshot(new CssRule('.my-rule',
            new CssProperty('color', 'blue'),
            new CssProperty('margin', '0'),
            new CssProperty('display', 'block'),
        ));
    }

    /**
     * @test
     */
    public function it_overwrites_properties_with_the_same_name(): void
    {
        $rule = new CssRule('.my-rule',
            new CssProperty('color', 'blue'),
            new CssProperty('margin', '0'),
            new CssProperty('display', 'block'),
        );

        $rule->setProperty(new CssProperty('display', 'inline'));

        $this->assertMatchesTextSnapshot($rule);
    }
}
