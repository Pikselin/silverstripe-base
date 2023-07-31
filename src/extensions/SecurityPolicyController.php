<?php

namespace Pikselin\base {

    use SilverStripe\Core\Config\Configurable;
    use SilverStripe\ORM\DataExtension;

    class SecurityPolicyController extends DataExtension
    {
        use Configurable;

        /**
         * @config
         */
        // set some defaults
        private static array $headers = [];
        private static array $csp_headers = [];
        private static bool $use_nonce = true;
        //private static $csp_type = 'Content-Security-Policy';
        private static bool $csp_type = false;
        private static array $nonceable = [
            'script-src',
            'script-src-elem'
        ];

        public function onAfterInit()
        {
            $csp_type = (null !== $this->config()->get('csp_type')) ? $this->config()->get('csp_type') : self::$csp_type;

            $headers = $this->config()->get('headers');

            // base headers
            if (is_array($headers)) {
                foreach ($headers as $k => $v) {
                    $this->owner->getResponse()->addHeader($k, $v);
                }
            }

            /*
             * Only apply CSP headers if the type is defined, defaults to false
             */
            if ($csp_type !== false) {
                $csp_headers = $this->config()->get('csp_headers');
                $use_nonce = (null !== $this->config()->get('use_nonce')) ? $this->config()->get('use_nonce') : self::$use_nonce;
                // CSP headers
                if (is_array($csp_headers)) {
                    $directives = [];

                    foreach ($csp_headers as $k => $v) {
                        if (is_array($v)) {
                            // include the nonce value if this directive is in the allowed list
                            if ($use_nonce && in_array($k, self::$nonceable, true)) {
                                $v[] = str_replace('%NONCE%', $this->owner->StoredNonce(), "'nonce-%NONCE%'");
                            }
                            $vals = implode(' ', $v);
                            $directives[] = str_replace(['%KEY%', '%VALS%'], [$k, $vals], "%KEY% %VALS%; ");
                        }
                    }
                    $cspdirectives = implode('', $directives);
                    $this->owner->getResponse()->addHeader($csp_type, $cspdirectives);
                }
            }
        }
    }

}
