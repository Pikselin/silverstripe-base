https://docs.silverstripe.org/en/4/developer_guides/customising_the_admin_interface/how_tos/extend_cms_interface/

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

## Override theme. 
Base theme can be overridden from within admin > settings

## CSP
Nonce value can get accessed via the page global $StoredNonce. Useful for all inline scripts.

You can also create CSP and general site headers using this module. Just create a yml config like the following:

    Pikselin\base\SecurityPolicyController:
    #  use_nonce: false
    #  csp_type: Content-Security-Policy
      headers:
        X-Frame-Options: SAMEORIGIN
        Referrer-Policy: same-origin
      csp_headers:
        default-src:
          - "'self'"
          - '*.googleapis.com'
          - '*.hotjar.com'
          - '*.youtube.com'
          - 'googleads.g.doubleclick.net'
          - '*.monsido.com'

[Information on how to generate CSP headers](https://report-uri.com/home/generate)

##
Tag manager and GA4. Just add the account ID for one of these to have them included

### Google analytics

    <% if $GACode %>$GACode<% end_if %>

#### Tag manager

    <% if $TagManagerNoScript %>$TagManagerNoScript<% end_if %>
    <% if $TagManagerCode %>$TagManagerCode<% end_if %>
