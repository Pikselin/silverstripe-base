<?php

namespace Pikselin\base {

    use SilverStripe\ORM\DataExtension;
    use SilverStripe\SiteConfig\SiteConfig;
    use SilverStripe\View\SSViewer;

    class BaseContentController extends DataExtension {

        public function onBeforeInit() {
            
            $SiteConfig = SiteConfig::current_site_config();
            if (!empty($SiteConfig->OverrideTheme)) {
                SSViewer::set_themes([$SiteConfig->OverrideTheme, SSViewer::DEFAULT_THEME]);
            }
        }
    }
}