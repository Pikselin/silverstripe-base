# Installation

    composer require Pikselin/base

# features

## Included modules
includes/requires the following modules

- [silverstripe/cms](https://github.com/silverstripe/silverstripe-cms)
- [silverstripe/framework](https://github.com/silverstripe/silverstripe-framework)
- [innoweb/silverstripe-social-metadata](https://github.com/xini/silverstripe-social-metadata)
- [silverstripe/googlesitemaps](https://github.com/wilr/silverstripe-googlesitemaps)
- [gorriecoe/silverstripe-menu](https://github.com/gorriecoe/silverstripe-menu)
- [ryanpotter/silverstripe-cms-theme](https://github.com/Rhym/silverstripe-cms-theme)
- [dnadesign/silverstripe-elemental](https://github.com/silverstripe/silverstripe-elemental)
- [purplespider/asset-alt-text](https://github.com/purplespider/silverstripe-asset-alt-text)
- [silverstripe/sharedraftcontent](https://github.com/silverstripe/silverstripe-sharedraftcontent)
- [silverstripe/environmentcheck](https://github.com/silverstripe/silverstripe-environmentcheck)
- [bringyourownideas/silverstripe-maintenance](https://github.com/bringyourownideas/silverstripe-maintenance/blob/master/docs/en/userguide/index.md)
- [jonom/focuspoint](https://github.com/jonom/silverstripe-focuspoint)
- [jonom/silverstripe-betternavigator](https://github.com/jonom/silverstripe-betternavigator)

## Override theme. 
Base theme can be overridden from within admin > settings

## Site email
This module adds a simple site email field to admin > settings. Access it via

    $SiteConfig.SiteEmail

## Global template helpers
A simple class is included that provides a few basic reusable methods for templates. See the helpers dir for details.

## Teaser extension
An extension is included that allows you to add teaser text and teaser image fields to any page type. This is useful when you want to display child pages in lists on landing pages etc.
To activate the extension add it via the extensions static

    private static $extensions = [
            TeaserExtension::class
        ];

Or in yml

    Page:
      extensions:
        - Pikselin\base\TeaserExtension

Full namespace for this extension

    namespace Pikselin\base\TeaserExtension;

## SVGIcon
A helper class is available that allows you to embed an SVG image from a sprite set file.

This will require some yml config to set the source file. The file must live in your public/{resources folder CONST} folder as this is currently used as a base

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

## Image upload validator class
Simple image upload validation for forms

example:

    $Image = new UploadField('Image', 'Image');
    $Image->setDescription('');
    $validator = new ImageUpload_Validator();
    $validator->setMinDimensions(500, 400);
    $validator->setAllowedExtensions(array('jpg', 'jpeg', 'png'));
    $Image->setValidator($validator);

## CSP
### Note
**Consider replacing this with Simon's CSP module**

[Firesphere/silverstripe-csp-headers](https://github.com/Firesphere/silverstripe-csp-headers)

Nonce value can get accessed via the page global $StoredNonce. Useful for all inline scripts.

You can also create CSP and general site headers using this module. No headers are provided by default (yet)

Just create a yml config like the following:

    _config/SecurityPolicy.yml

    Pikselin\base\SecurityPolicyController:
    #  use_nonce: false
    #  csp_type: Content-Security-Policy
    #  csp_type: false /* setting to false disables CSP header inclusion but won't disable standard headers*/
    #  possible options [Content-Security-Policy, Content-Security-Policy-Report-Only, false]
    #  https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
      headers:
        X-Frame-Options: SAMEORIGIN
        Referrer-Policy: same-origin
        X-Content-Type-Options: nosniff
        Permissions-Policy: "camera=(), cross-origin-isolated=*, fullscreen=(*)"
        Strict-Transport-Security: "max-age=31536000; includeSubDomains"
        X-Powered-By: "xxx"
        Access-Control-Allow-Origin: "*"
      csp_headers:
        default-src:
          - "'self'"
          - "data:"
          - unsafe-inline
          - unsafe-eval      
          - '*.googleapis.com'
          - '*.hotjar.com'
          - '*.youtube.com'
          - 'googleads.g.doubleclick.net'
          - '*.monsido.com'
        script-src:
          - "'self'"
          - "data:"
          - unsafe-inline
          - unsafe-eval    


[Information on how to generate CSP headers](https://report-uri.com/home/generate)

##
Tag manager and GA4. Just add the account ID for one of these to have them included

### Google analytics

    <% if $GACode %>$GACode<% end_if %>

#### Tag manager

    <% if $TagManagerNoScript %>$TagManagerNoScript<% end_if %>
    <% if $TagManagerCode %>$TagManagerCode<% end_if %>
