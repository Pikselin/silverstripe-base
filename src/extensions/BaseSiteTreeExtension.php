<?php

namespace Pikselin\base;

use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\ArrayData;

class BaseSiteTreeExtension extends DataExtension {

    public function GACode() {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->GACode)) {
            $arrayData = new ArrayData([
                'GACode' => $SiteConfig->GACode,
                'StoredNonce' => $this->owner->StoredNonce()
            ]);

            return $arrayData->renderWith('GACode');
        }
        return false;
    }

    public function TagManagerCode() {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->TagManager)) {
            $arrayData = new ArrayData([
                'TagManagerCode' => $SiteConfig->TagManager,
                'StoredNonce' => $this->owner->StoredNonce()
            ]);

            return $arrayData->renderWith('TagManagerCode');
        }
        return false;
    }

    public function TagManagerNoScript() {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->TagManager)) {
            $arrayData = new ArrayData([
                'TagManagerCode' => $SiteConfig->TagManager
            ]);

            return $arrayData->renderWith('TagManagerNoScript');
        }
        return false;
    }
}
