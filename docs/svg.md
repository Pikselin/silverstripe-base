## SVGs

A helper class is available that allows you to embed an SVG image from a sprite set file.

This will require some yml config to set the source file. The file must live in your public/{resources folder CONST} folder as this is currently used as a base.

example yml config:

    pikselin\base\SVGIcon:
      icon_file: themes/pikselin/dist/images/sprite.icons.svg
      image_files:
        icons:
          icon_file: themes/pikselin/dist/images/sprite.icons.svg
        symbol:
          icon_file: themes/pikselin/dist/images/sprite.symbol.svg

If you only have a single sprite file then use `icon_file`. If you have multiple icon files then use the `image_files` array.

To access either config use the following template helpers

Template usage:

    $SVGIcon($Icon, $tag, $title)

    $SVGIcon('id-of-image-to-display' 'span'(optional), 'title' (optional))

    $SVGIcon('arrow-back','span','here is my title single file title')

Add the icon set key if pulling from the `image_files` array

    $SVGIconSet('icons','arrow-back','span','here is my title')

Mark-up generated:

    <$tag class="svg-icon svg-icon-$Icon">
        <svg>($title) ? '<title>' . $title . '</title>
              <use xlink:href="/_resources/{path to icon file}#$Icon"></use>
	</svg>
    </$tag>
