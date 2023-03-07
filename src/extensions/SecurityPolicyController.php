<?php

namespace Pikselin\base {

    use SilverStripe\Core\Config\Configurable;
    use SilverStripe\ORM\DataExtension;

    class SecurityPolicyController extends DataExtension {

        use Configurable;

        /**
         * @config
         */
        
        // set some defaults
        private static $headers = [];
        private static $csp_headers = [];
        private static $use_nonce = true;
        private static $csp_type = 'Content-Security-Policy';
        private static $nonceable = [
            
        ];

        public function onBeforeInit() {
            $headers = $this->config()->get('headers');
            $csp_headers = $this->config()->get('csp_headers');
            $use_nonce = (null !== $this->config()->get('use_nonce')) ? $this->config()->get('use_nonce') : self::$use_nonce;
            $csp_type = (null !== $this->config()->get('csp_type')) ? $this->config()->get('csp_type') : self::$csp_type;
            // base headers
            if (is_array($headers)) {
                foreach ($headers as $k => $v) {
                    $this->owner->getResponse()->addHeader($k, $v);
                }
            }


            // CSP headers
            if (is_array($csp_headers)) {
                $directives = [];

                foreach ($csp_headers as $k => $v) {
                    if (is_array($v)) {
                        if ($use_nonce) {
                            $v[] = '\'nonce-' . $this->owner->StoredNonce().'\'';
                        }
                        $vals = implode(' ', $v);
                        $directives[] = $k . ' ' . $vals . ';';
                    }
                }
                $cspdirectives = implode('', $directives);
                $this->owner->getResponse()->addHeader($csp_type, $cspdirectives);
            }
        }

    }

}