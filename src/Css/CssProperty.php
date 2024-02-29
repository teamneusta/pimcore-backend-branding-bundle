<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Css;

final class CssProperty
{
    public function __construct(
        public readonly string $name,
        private readonly string $value,
        private readonly bool $isUrl = false,
        private readonly bool $isImportant = false,
    ) {
    }

    public function __toString(): string
    {
        $property = $this->isUrl
            ? sprintf('%s: url("%s")', $this->name, $this->value)
            : sprintf('%s: %s', $this->name, $this->value);

        if ($this->isImportant) {
            $property .= ' !important';
        }

        return $property;
    }
}
