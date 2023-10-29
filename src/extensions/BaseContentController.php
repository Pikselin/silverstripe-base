<?php

namespace Pikselin\base {

    use DNADesign\Elemental\Models\ElementalArea;
    use Pikselin\Extensions\Carousel\CarouselExtensionController;
    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Core\Config\Config;
    use SilverStripe\ORM\DataExtension;
    use SilverStripe\SiteConfig\SiteConfig;
    use SilverStripe\View\SSViewer;

    /**
 * Class \Pikselin\base\BaseContentController
 *
 * @property ContentController|BaseContentController $owner
 */
class BaseContentController extends DataExtension
    {
        public function onBeforeInit()
        {
            //echo Config::inst()->get(CarouselExtensionController::class, 'test_string');
            //Config::modify()->merge(CarouselExtensionController::class, 'test_string', 'overridden test string');
            //echo Config::inst()->get(CarouselExtensionController::class, 'test_string');
            // check current page for override theme
            if(!$this->owner instanceof ContentController || $this->owner->ClassName == 'DNADesign\ElementalUserForms\Model\ElementForm') {
                return;
            }  else {
                $PBClosestTheme = $this->owner->PBClosestTheme($this->owner->Parent());
            }

            if (!empty($this->owner->PB_Theme)) {
                SSViewer::set_themes([$this->owner->PB_Theme, SSViewer::DEFAULT_THEME]);
                return;
            }

            //$PBClosestTheme = $this->owner->PBClosestTheme($this->owner);
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
