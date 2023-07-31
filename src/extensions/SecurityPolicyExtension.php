<?php

namespace Pikselin\base {

use SilverStripe\ORM\DataExtension;

    class SecurityPolicyExtension extends DataExtension
    {
        protected function getNonce(int $length = 16): string
        {
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
        public function StoredNonce()
        {
            static $nonce = null;

            if ($nonce === null) {
                $nonce = $this->getNonce();
            }
            return $nonce;
        }
    }

}
