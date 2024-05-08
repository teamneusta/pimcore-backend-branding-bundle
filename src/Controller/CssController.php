<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Controller;

use Neusta\Pimcore\BackendBrandingBundle\CssProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController, Route('/neusta/backend-branding/css', name: 'neusta_pimcore_backend_branding_css')]
final class CssController
{
    public function __construct(
        private readonly CssProvider $cssProvider,
    ) {
    }

    public function __invoke(): Response
    {
        return new Response(
            $this->cssProvider->getRules()->toString(),
            Response::HTTP_OK,
            ['Content-type' => 'text/css'],
        );
    }
}
