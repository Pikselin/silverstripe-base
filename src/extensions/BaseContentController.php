<?php

namespace Pikselin\base {

    use SilverStripe\ORM\DataExtension;
    use SilverStripe\SiteConfig\SiteConfig;
    use SilverStripe\View\SSViewer;

    class BaseContentController extends DataExtension
    {
        public function onBeforeInit()
        {
            // check current page for override theme
            if (!empty($this->owner->PB_Theme)) {
                SSViewer::set_themes([$this->owner->PB_Theme, SSViewer::DEFAULT_THEME]);
                return;
            }

            $PBClosestTheme = $this->owner->PBClosestTheme($this->owner->Parent());
            if (!empty($PBClosestTheme)) {
                SSViewer::set_themes([$PBClosestTheme, SSViewer::DEFAULT_THEME]);
                return;
            }

            // Check global settings override
            $SiteConfig = SiteConfig::current_site_config();
            if (!empty($SiteConfig->PB_OverrideTheme)) {
                SSViewer::set_themes([$SiteConfig->PB_OverrideTheme, SSViewer::DEFAULT_THEME]);
                return;
            }
        }

        public function PBClosestTheme($page = false)
        {

            if(isset($page->ID) && $page->ID <= 0 ) {
                return false;
            }

            if ($page === false) {
                $page = $this->owner;
            }
            if (!empty($page->PB_Theme)) {
                return $page->PB_Theme;
            } else {
                return $this->owner->PBClosestTheme($page->Parent());
            }
        }
    }
}
