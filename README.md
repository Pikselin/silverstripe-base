# Installation

    composer require Pikselin/base

# features

## Included modules
includes the following modules

    innoweb/silverstripe-social-metadata
    silverstripe/googlesitemaps
    gorriecoe/silverstripe-menu
    ryanpotter/silverstripe-cms-theme
    dnadesign/silverstripe-elemental
    pikselin/silverstripe-admin-edit-link
    purplespider/asset-alt-text
    silverstripe/sharedraftcontent

## Override theme. 
Base theme can be overridden from within admin > settings

## Site email
This module adds a simple site email field to admin > settings. Access it via

    $SiteConfig.SiteEmail

## Global template helpers
A simple class is included that provides a few basic reusable methods for templates. See the helpers dir for details.

## SVGIcon
A helper class is available that allows you to embed an SVG image from a sprite set file.

This will require some yml config to set the source file. The file must live in your public/{resources folder CONST} folder as this is currently used as a base

example yml config:

    pikselin\base\SVGIcon:
      icon_file: themes/mytheme/dist/images/sprite.symbol.svg

If this file doesnt exist then the template helper won't display anything.

Template usage:

    $SVGIcon($Icon, $tag, $title)

    $SVGIcon($Icon = 'id-of-image-to-display' [tag=span](optional), [title=false](optional))

Mark-up generated:

    <$tag class="svg-icon svg-icon-$Icon">
        <svg>($title) ? '<title>' . $title . '</title>
              <use xlink:href="/_resources/{path to icon file}#$Icon"></use>
	</svg>
    </$tag>

### future considerations for the icon file

Add more than one sprite source using yml configs, example:
pikselin\base\SVGIcon:
  image_files:
    industry_icons:
      icon_file: themes/mytheme/dist/images/industry.symbol.svg
    navigation_icons:
      icon_file: themes/mytheme/dist/images/navigation.symbol.svg

then add an Icon using:

    $SVGIcon('industry_icons, 'industry-sheep, 'span', 'Sheep industry')

Move mark-up to an include template that uses

    $this->renderWith('SVGIcon');

to allow theme lever overrides.


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
