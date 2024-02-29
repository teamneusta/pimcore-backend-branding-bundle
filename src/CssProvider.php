<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssRule;

final class CssProvider
{
    /**
     * @param iterable<callable():iterable<CssRule>> $providers
     */
    public function __construct(
        private readonly iterable $providers,
    ) {
    }

    /**
     * @param array<mixed> $config
     *
     * @return iterable<CssRule>
     */
    public function __invoke(array $config): iterable
    {
        foreach ($this->providers as $provider) {
            \assert(\is_callable($provider), sprintf('Provider "%s" is not callable.', get_debug_type($provider)));

            $reflector = new \ReflectionFunction($provider(...));

            $arguments = [];
            foreach ($reflector->getParameters() as $parameter) {
                $name = $parameter->getName();
                $type = $parameter->getType();

                \assert(
                    $type instanceof \ReflectionNamedType,
                    sprintf('Parameter "%s" of provider "%s" has no or more than one type.', $name, get_debug_type($provider)),
                );

                $typeName = $type->getName();

                \assert(
                    \in_array($typeName, ['array', 'bool', 'float', 'int', 'string']) || class_exists($typeName),
                    sprintf('Parameter "%s" of provider "%s" has an unsupported type "%s".', $name, get_debug_type($provider), $typeName),
                );

                if (isset($config[$name])) {
                    $argument = $config[$name];

                    if (class_exists($typeName)) {
                        $argument = new $typeName(...$argument);
                    }

                    $arguments[$name] = $argument;
                }
            }

            if ($arguments || !$reflector->getNumberOfParameters()) {
                yield from $provider(...$arguments);
            }
        }
    }
}
