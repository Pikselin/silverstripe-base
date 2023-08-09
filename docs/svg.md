## SVGs

[stevie-mayhew/silverstripe-svg](https://github.com/stevie-mayhew/silverstripe-svg)

## Configuration

You can set the base path for where your SVG's are stored. You can also add extra default classes to the SVG output

**app/_config/svg.yml**
```yaml
StevieMayhew\SilverStripeSVG\SVGTemplate:
base_path: 'themes/mythemename/path/to/svgs/'
default_extra_classes:
  - 'svg-image'
```

## Usage
In a SilverStripe template simply call the SVG template helper.

```html
<!-- add svg -->
{$SVG('name')}
<!-- add svg with id 'testid' -->
{$SVG('with-id', 'testid')}
```

There also helper functions for width, height, size, fill, adding extra classes, setting a custom/alternative base path and specifying a sub-folder within the base path (for those who want to categories and folder off your images).

```html
<!-- change width -->
{$SVG('name').width(200)}

<!-- change height -->
{$SVG('name').height(200)}

<!-- change size (width and height) -->
{$SVG('name').size(100,100)}

<!-- change fill -->
{$SVG('name').fill('#FF9933')}

<!-- change stroke -->
{$SVG('name').stroke('#FF9933')}

<!-- add class -->
{$SVG('name').extraClass('awesome-svg')}

<!-- specify a custom base path -->
{$SVG('name').customBasePath('assets/Uploads/SVG')}

<!-- specify a sub-folder of the base path (can be called multiple times) -->
{$SVG('name').addSubfolder('MyDir')}
{$SVG('name').addSubfolder('MyDir/MyOtherDir')}
{$SVG('name').addSubfolder('MyDir').addSubfolder('MyOtherDir')}
These options are also chainable.

{$SVG('name').fill('#45FABD').width(200).height(100).extraClass('awesome-svg').customBasePath('assets/Uploads/SVG').addSubfolder('MyDir')}
```
