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
            if (!empty($this->owner->Theme)) {
                SSViewer::set_themes([$this->owner->Theme, SSViewer::DEFAULT_THEME]);
                return;
            }

            // recurse up the page tree
            $ClosetTheme = $this->owner->ClosestTheme($this->owner->Parent());
            if (!empty($ClosetTheme)) {
                SSViewer::set_themes([$ClosetTheme, SSViewer::DEFAULT_THEME]);
                return;
            }

            // Check global settings override
            $SiteConfig = SiteConfig::current_site_config();
            if (!empty($SiteConfig->OverrideTheme)) {
                SSViewer::set_themes([$SiteConfig->OverrideTheme, SSViewer::DEFAULT_THEME]);
                return;
            }
        }

        public function ClosestTheme($page = false): string
        {
            if ($page === false) {
                $page = $this->owner;
            }
            if (!empty($page->Theme)) {
                return $page->Theme;
            } else {
                return $this->owner->ClosestTheme($page->Parent());
            }
        }
    }
}
