<?php

namespace Pikselin\base {

use SilverStripe\Core\Config\Configurable;
use SilverStripe\ORM\DataExtension;

    class SecurityPolicy extends DataExtension {

        use Configurable;
        /**
         * @config
         */
        private static $headers = [];
        private static $csp_headers = [];
        
        public function onBeforeInit() {
            $headers = $this->config()->get('headers');
            $csp_headers = $this->config()->get('csp_headers');
            
            print_r($headers);
            print_r($csp_headers);  
            // base headers
            if(is_array($headers)) {
            foreach ($headers as $k => $v) {
                $this->owner->getResponse()->addHeader($k, $v);
            }                
            }

            
            // CSP headers
            if(is_array($csp_headers)) {
                $directives = [];
                foreach($csp_headers as $k => $v) {
                    // is the value also an array
                    if(is_array($v)) {
                        $vals = implode(' ',$v);
                        $directives[] = $k.' '.$vals.';';
                    }
                }
                $cspdirectives = implode('', $directives);
                $this->owner->getResponse()->addHeader('Content-Security-Policy', $cspdirectives);
            }
        }
    }
}