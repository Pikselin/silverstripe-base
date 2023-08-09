<?php
//
//namespace pikselin\base;
//
//use SilverStripe\Control\Director;
//use SilverStripe\Core\Config\Configurable;
//
//class SVGIcon {
//
//    use Configurable;
//
//    /**
//     * Gets the available icons from our master SVG sprite
//     *
//     * @return array|string[]
//     * pikselin\base\SVGIcon:
//        icon_file: silverstripe-base/client/images/sprite.symbol.svg
//          image_files:
//            industry_icons:
//              icon_file: themes/mytheme/dist/images/industry.symbol.svg
//            navigation_icons:
//              icon_file: themes/mytheme/dist/images/navigation.symbol.svg
//     */
//    public function getIconOptions($set = false) {
//        if ($set == false) {
//            $icon_file = (null !== $this->config()->get('icon_file')) ? $this->config()->get('icon_file') : false;
//        } else {
//            $icon_file_set = (null !== $this->config()->get('image_files')) ? $this->config()->get('image_files') : false;
//            if (isset($icon_file_set[$set])) {
//                $icon_file = $icon_file_set[$set]['icon_file'];
//            }
//        }
//        if ($icon_file !== false) {
//            $svg_path = Director::baseFolder() . '/public/' . RESOURCES_DIR . '/' . $icon_file;
//            if (file_exists($svg_path)) {
//                $content = file_get_contents($svg_path);
//                preg_match_all('/id="([\w|-]*)"/', $content, $output_array);
//                if (!empty($output_array[1])) {
//                    $arrIcons = $output_array[1];
//                    $return = [];
//                    foreach ($arrIcons as $icon) {
//                        $return[$icon] = $icon;
//                    }
//                    return $return;
//                }
//            }
//        }
//        // if we've got to here, then something's gone wrong
//        return ['' => 'No SVG file found'];
//    }
//
//    /**
//     * Checks to see if an icon exists in our master SVG sprite
//     *
//     * @param $icon
//     *
//     * @return bool
//     */
//    public function iconExists($icon, $set = false) {
//        $icon = strtolower($icon);
//        $icons = $this->getIconOptions($set);
//        return (isset($icons[$icon]));
//    }
//
//}
