<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle;

use Neusta\Pimcore\BackendBrandingBundle\Settings\Signet;
use Neusta\Pimcore\BackendBrandingBundle\Settings\TabBarIcon;
use Neusta\Pimcore\BackendBrandingBundle\Settings\Title;

/** @immutable */
final class Settings
{
    public ?Title $title;
    public string $favIcon;
    public string $bezelColor;
    public string $sidebarColor;
    public Signet $signet;
    public TabBarIcon $tabBarIcon;
}
