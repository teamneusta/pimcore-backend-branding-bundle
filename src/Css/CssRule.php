<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Css;

final class CssRule
{
    private readonly string $selector;
    /** @var array<string, CssProperty> */
    private array $properties;

    public function __construct(string $selector, CssProperty ...$properties)
    {
        $this->selector = $selector;

        foreach ($properties as $property) {
            $this->setProperty($property);
        }
    }

    public function setProperty(CssProperty $property): self
    {
        $this->properties[$property->name] = $property;

        return $this;
    }

    public function __toString(): string
    {
        $css = $this->selector . " {\n";
        foreach ($this->properties as $property) {
            $css .= "\t{$property};\n";
        }
        $css .= "}\n";

        return $css;
    }
}
