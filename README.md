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

## CSP nonce
Nonce value can get accessed via the page global $StoredNonce. Useful for all JA inline scripts.

##
Tag manager and GA4. Just add the account ID for one of these to have them included

### Google analytics
    <% if $GACode %>$GACode<% end_if %>


#### Tag manager
    <% if $SiteConfig.TagManagerNoScript %>$SiteConfig.TagManagerNoScript<% end_if %>
    <% if $SiteConfig.TagManagerCode %>$SiteConfig.TagManagerCode<% end_if %>
