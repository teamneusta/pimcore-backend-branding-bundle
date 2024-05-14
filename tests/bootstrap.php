<?php declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationReader;
use Neusta\Pimcore\TestingFramework\Pimcore\BootstrapPimcore;

require_once __DIR__ . '/../vendor/autoload.php';

AnnotationReader::addGlobalIgnoredName('immutable');

BootstrapPimcore::bootstrap(
    PIMCORE_PROJECT_ROOT: __DIR__ . '/app',
    KERNEL_CLASS: TestKernel::class,
);
