<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class SettingsFactory
{
    public function __construct(
        private readonly array $config,
        private readonly DenormalizerInterface $denormalizer,
    ) {
    }

    public function create(string $env): Settings
    {
        return $this->denormalizer->denormalize($this->config[$env] ?? [], Settings::class);
    }
}
