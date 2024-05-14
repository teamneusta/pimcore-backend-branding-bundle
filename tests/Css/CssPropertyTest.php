<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Tests\Css;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssProperty;
use PHPUnit\Framework\TestCase;

class CssPropertyTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_name_and_value(): void
    {
        self::assertSame('color: red', (string) new CssProperty('color', 'red'));
    }

    /**
     * @test
     */
    public function its_value_may_be_a_url(): void
    {
        self::assertSame(
            'background-image: url("image.jpeg")',
            (string) new CssProperty('background-image', 'image.jpeg', isUrl: true),
        );
    }

    /**
     * @test
     */
    public function it_may_be_important(): void
    {
        self::assertSame(
            'color: red !important',
            (string) new CssProperty('color', 'red', isImportant: true),
        );

        self::assertSame(
            'background-image: url("image.jpeg") !important',
            (string) new CssProperty('background-image', 'image.jpeg', isUrl: true, isImportant: true),
        );
    }
}
