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
            $this->owner->getResponse()->addHeader('X-Powered-By', "ASH");
            

        }
    }
}