<?php
//
//namespace pikselin\base;
//
//use pikselin\base\SVGIcon;
//use SilverStripe\Core\Config\Configurable;
//use SilverStripe\View\ArrayData;
//use SilverStripe\View\TemplateGlobalProvider;
//
///**
// * Template method provider to load an SVG asset from font awesome.
// *
// * This is used so that we do not need to load all font awesome webfonts
// * for icons we are using in templates.
// */
//abstract class IconSvgProvider implements TemplateGlobalProvider {
//
//    use Configurable;
//
//    /**
//     * Creates the template method by which we can create our custom Icons using
//     * a template shortcut, in this case $SVGIcon($IconName)
//     *
//     * {@inheritDoc}
//     */
//    public static function get_template_global_variables() {
//        return [
//            'SVGIcon' => [
//                'method' => 'getSvg',
//                'casting' => 'HTMLFragment',
//            ],
//            'SVGIconSet' => [
//                'method' => 'getSvgFromSet',
//                'casting' => 'HTMLFragment',
//            ],
//        ];
//    }
//
//    /**
//     * Creates the div that renders out our SVG from the sprite master
//     *
//     * @param $Icon
//     *
//     * @return string
//     */
//    public static function getSvg($Icon, $wrapper = 'span', $title = FALSE) {
//        $SVGIcon = new SVGIcon();
//        $Icon = strtolower($Icon);
//        $Exists = $SVGIcon->iconExists($Icon);
//
//        // sanity check
//        if (!$Exists) {
//            return 'no icon';
//        }
//
//        if (!empty($title)) {
//            $title = htmlspecialchars($title);
//        }
//
//        $icon_file = (null !== $SVGIcon->config()->get('icon_file')) ? $SVGIcon->config()->get('icon_file') : false;
//        //$image_files = (null !== $SVGIcon->config()->get('image_files')) ? $SVGIcon->config()->get('image_files') : false;
//        $arrayData = new ArrayData([
//            'wrapper' => $wrapper,
//            'Icon' => $Icon,
//            'title' => $title,
//            'icon_file' => $icon_file,
//            'resourcesDir' => RESOURCES_DIR
//        ]);
//
//        return $arrayData->renderWith('SVGIcon');
//    }
//
//    public static function getSvgFromSet($Set, $Icon, $wrapper = 'span', $title = FALSE) {
//        $SVGIcon = new SVGIcon();
//        $Icon = strtolower($Icon);
//        $Exists = $SVGIcon->iconExists($Icon,$Set);
//
//        // sanity check
//        if (!$Exists) {
//            return 'no icon';
//        }
//
//        if (!empty($title)) {
//            $title = htmlspecialchars($title);
//        }
//
//        //$icon_file = (null !== $SVGIcon->config()->get('icon_file')) ? $SVGIcon->config()->get('icon_file') : false;
//        $icon_files = (null !== $SVGIcon->config()->get('image_files')) ? $SVGIcon->config()->get('image_files') : false;
//        $arrayData = new ArrayData([
//            'wrapper' => $wrapper,
//            'Icon' => $Icon,
//            'title' => $title,
//            'icon_file' => $icon_files[$Set]['icon_file'],
//            'resourcesDir' => RESOURCES_DIR
//        ]);
//
//        return $arrayData->renderWith('SVGIcon');
//    }
//
//}
