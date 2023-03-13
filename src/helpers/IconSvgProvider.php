<?php

namespace pikselin\base;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\View\TemplateGlobalProvider;
use pikselin\base\SVGIcon;

/**
 * Template method provider to load an SVG asset from font awesome.
 *
 * This is used so that we do not need to load all font awesome webfonts
 * for icons we are using in templates.
 */
abstract class IconSvgProvider implements TemplateGlobalProvider {

    use Configurable;

    /**
     * Creates the template method by which we can create our custom Icons using
     * a template shortcut, in this case $SVGIcon($IconName)
     *
     * {@inheritDoc}
     */
    public static function get_template_global_variables() {
        return [
            'SVGIcon' => [
                'method' => 'getSvg',
                'casting' => 'HTMLFragment',
            ],
        ];
    }

    /**
     * Creates the div that renders out our SVG from the sprite master
     *
     * @param $Icon
     *
     * @return string
     */
    public static function getSvg($Icon, $wrapper = 'span', $title = FALSE) {
        $SVGIcon = new SVGIcon();
        $Icon = strtolower($Icon);
        $Exists = $SVGIcon->iconExists($Icon);

        // sanity check
        if (!$Exists) {
            return 'no icon';
        }

        if (!empty($title)) {
            $title = htmlspecialchars($title);
        }

        $icon_file = (null !== $SVGIcon->config()->get('icon_file')) ? $SVGIcon->config()->get('icon_file') : false;

        return '<' . $wrapper . ' class="svg-icon svg-icon-' . $Icon . '">
		<svg>' . (($title) ? '<title>' . $title . '</title>' : '') .
                '<use xlink:href="/_resources/' . $icon_file . '#' . $Icon . '"></use>
		</svg>
                </' . $wrapper . '>';
    }

}
