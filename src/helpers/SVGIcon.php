<?php

namespace pikselin\base;

use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Configurable;

class SVGIcon {

    use Configurable;

    /**
     * Gets the available icons from our master SVG sprite
     *
     * @return array|string[]
     */
    public function getIconOptions() {
        $icon_file = (null !== $this->config()->get('icon_file')) ? $this->config()->get('icon_file') : false;
        if ($icon_file !== false) {
            $svg_path = Director::baseFolder() . '/public/' . RESOURCES_DIR . '/' . $icon_file;
            // make sure it exists!
            if (file_exists($svg_path)) {
                $content = file_get_contents($svg_path);
                preg_match_all('/id="([\w|-]*)"/', $content, $output_array);
                if (!empty($output_array[1])) {
                    $arrIcons = $output_array[1];
                    $return = [];
                    foreach ($arrIcons as $icon) {
                        //if (strpos($icon, 'industry',0) !== false|| $includeAll == true) {
                        $return[$icon] = $icon;
                        //}
                    }
                    return $return;
                }
            }
        }
        // if we've got to here, then something's gone wrong
        return ['' => 'No SVG file found'];
    }

    /**
     * Checks to see if an icon exists in our master SVG sprite
     *
     * @param $icon
     *
     * @return bool
     */
    public function iconExists($icon) {
        $icon = strtolower($icon);
        $icons = $this->getIconOptions();
        return (isset($icons[$icon]));
    }

}
