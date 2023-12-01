<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\EventListener;

use Pimcore\Event\BundleManager\PathsEvent;
use Pimcore\Event\BundleManagerEvents;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class BackendAssetsListener
{
    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    #[AsEventListener(BundleManagerEvents::CSS_PATHS)]
    public function addCss(PathsEvent $event): void
    {
        $event->addPaths([$this->urlGenerator->generate('neusta_pimcore_backend_branding_css')]);
    }

    #[AsEventListener(BundleManagerEvents::JS_PATHS)]
    public function addJs(PathsEvent $event): void
    {
        $event->addPaths([$this->urlGenerator->generate('neusta_pimcore_backend_branding_js')]);
    }
}
