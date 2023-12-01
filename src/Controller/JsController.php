<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController, Route('/neusta/backend-branding/js', name: 'neusta_pimcore_backend_branding_js')]
final class JsController
{
    /**
     * @param array<string, array{favIcon: string}> $config
     */
    public function __construct(
        private readonly string $env,
        private readonly array $config,
    ) {
    }

    public function __invoke(): Response
    {
        $js = [];

        if ($favIcon = $this->config[$this->env]['favIcon'] ?? null) {
            $js[] = <<<JS
                document.querySelector("link[rel*='icon']").href = '{$favIcon}';
                JS;
        }

        return new Response(implode("\n", $js), Response::HTTP_OK, ['Content-type' => 'text/javascript']);
    }
}
