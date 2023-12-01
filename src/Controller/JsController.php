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
    /**
     * @param array<string, array{
     *     favIcon: string,
     *     title: array{login: string|null, backend: string|null},
     * }> $config
     */
    public function __construct(
        private readonly string $env,
        private readonly array $config,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $config = $this->config[$this->env] ?? [];
        $js = [];

        return new Response(implode("\n", $js), Response::HTTP_OK, ['Content-type' => 'text/javascript']);
    }
}
