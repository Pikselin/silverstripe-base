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
        
        public function onBeforeInit() {
            
            // add csp headers
            
            
            foreach (self::$headers as $k => $v) {
                $this->owner->getResponse()->addHeader($k, $v);    
            }
            
            

        }
    }
}