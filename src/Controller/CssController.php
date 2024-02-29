<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle\Controller;

use Neusta\Pimcore\BackendBrandingBundle\Css\CssRuleList;
use Neusta\Pimcore\BackendBrandingBundle\CssProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController, Route('/neusta/backend-branding/css', name: 'neusta_pimcore_backend_branding_css')]
final class CssController
{
    /**
     * @param array<string, array<mixed>> $config Configuration by environment
     */
    public function __construct(
        private readonly string $env,
        private readonly array $config,
        private readonly CssProvider $cssProvider,
    ) {
    }

    public function __invoke(): Response
    {
        $config = $this->config[$this->env] ?? [];
        $css = new CssRuleList();

        foreach (($this->cssProvider)($config) as $rule) {
            $css->addRule($rule);
        }

        return new Response($css->toString(), Response::HTTP_OK, ['Content-type' => 'text/css']);
    }
}
