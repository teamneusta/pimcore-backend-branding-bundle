<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController, Route('/neusta/backend-branding/js', name: 'neusta_pimcore_backend_branding_js')]
final class JsController
{
    public function __invoke(Request $request): Response
    {
        $js = [];

        return new Response(
            implode("\n", $js),
            Response::HTTP_OK,
            ['Content-type' => 'text/javascript'],
        );
    }
}
