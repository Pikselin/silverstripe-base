# Installation

    composer require Pikselin/base

# features

##
includes the following modules

    innoweb/silverstripe-social-metadata
    silverstripe/googlesitemaps
    gorriecoe/silverstripe-menu
    ryanpotter/silverstripe-cms-theme
    dnadesign/silverstripe-elemental
    nswdpc/silverstripe-csp
    pikselin/silverstripe-admin-edit-link

## Override theme. 
Base theme can be overridden from within admin > settings

## Site email
This module adds a simple site email field to admin > settings. Access it via

    $SiteConfig.SiteEmail

## Global template helpers
A simple class is included that provides a few basic reusable methods for templates. See the helpers dir for details.

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
