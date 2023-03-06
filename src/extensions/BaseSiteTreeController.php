<?php

namespace Pikselin\base;

use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\ArrayData;

class BaseSiteTreeController extends DataExtension {

    public function GACode() {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->GACode)) {
            $arrayData = new ArrayData([
                'GACode' => $SiteConfig->GACode,
                'StoredNonce' => $this->owner->StoredNonce()
            ]);

            return $arrayData->renderWith('GACode');
        }
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
    }

    public function TagManagerNoScript() {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->TagManager)) {
            $arrayData = new ArrayData([
                'TagManagerCode' => $SiteConfig->TagManager
            ]);

            return $arrayData->renderWith('TagManagerNoScript');
        }
    }

    protected function getNonce(int $length = 16): string {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * Store the nonce in a static var so it can it be called by both the template and the CSP directive
     * but still last only for this instance (page load).
     *
     * @return string|null
     */
    public function StoredNonce() {
        static $nonce = null;

        if ($nonce === null) {
            $nonce = $this->getNonce();
        }
        return $nonce;
    }

}
