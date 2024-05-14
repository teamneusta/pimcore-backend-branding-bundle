<?php
declare(strict_types=1);

namespace Neusta\Pimcore\BackendBrandingBundle;

use Neusta\Pimcore\BackendBrandingBundle\Settings\Signet;
use Neusta\Pimcore\BackendBrandingBundle\Settings\TabBarIcon;
use Neusta\Pimcore\BackendBrandingBundle\Settings\Title;
use Symfony\Component\Serializer\Annotation\SerializedName;

/** @immutable */
final class Settings
{
    public ?Title $title;
    public string $favicon;
    #[SerializedName('bezel_color')]
    public string $bezelColor;
    #[SerializedName('sidebar_color')]
    public string $sidebarColor;
    public Signet $signet;
    #[SerializedName('tab_bar_icon')]
    public TabBarIcon $tabBarIcon;
}
