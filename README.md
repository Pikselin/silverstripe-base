# Installation

    composer require Pikselin/base

*This module will start to use tagging from the first release. Tag numbers will match the Silverstripe release version, for example, for Silverstripe 4, the tag format will be 4.x.x*

# Features

## Included modules
includes/requires the following modules

See the composer.json file for the full list of included modules. Some initial set-up documentation will is include here to expose what new features this module makes available.

# Table of contents

- [Global config](docs/globalconfig.md) *Site config fields*
- [Extensions](docs/extensions.md) *Content teaser and upload validator*
- [Security Policy headers](docs/csp.md) *CSP set-up*
- [Global template helpers](docs/helpers.md) *General template and code helpers*
- [Elemental](docs/elemental.md) *Content management objects*
- [Images](docs/images.md) *Image management and manipulation*
- [SVGs](docs/svg.md) *SVG helper functions*
- [Additional CMS fields](docs/fields.md) *New field types*
- [Development](docs/development.md) *Developer tools*
- [Forms](docs/forms.md) *Extending form functionality*
- [Page banners](https://github.com/Pikselin/silverstripe-pagebanners) *Page and site level alerts*

## Passive extensions

A number of code classes and extensions exist that support the functionality mentioned below. These are in the [extensions](../extensions/). These extensions initialise features mentioned in this document.

## Themes

A Bootstrap based theme is included with this module.

**Do not delete me yet**
```yaml

"jonom/silverstripe-betternavigator": "^5.4",
"silverstripe/sharedraftcontent": "^2.8|^3",
"ryanpotter/silverstripe-cms-theme": "dev-master#44a15b6a071bd36c57d0a72ecb0e3d141e5a86d0",
"silverstripe/redirectedurls": "^2.2",
"symbiote/silverstripe-advancedworkflow": "^5.9",
"symbiote/silverstripe-multivaluefield": "^5.4",
"gorriecoe/silverstripe-link": "^1.4",

"innoweb/silverstripe-page-icons": "^2.4",
"silverstripe/docstation": "dev-main#a8b42061437a972a8f311fb8a8fcd53d4dde092b",
"silverstripe/taxonomy": "^2.5|^3",
"axllent/silverstripe-email-obfuscator": "^2.1",
"silverstripe/mimevalidator": "^2.5",

"silverstripe/textextraction": "^3.5",
"silverstripe/spellcheck": "^2.5",
"lekoala/silverstripe-cms-actions": "^1.4",
"silverstripe/contentreview": "^4.7",



"quinninteractive/silverstripe-seo": "^1.1",

"silverstripe/googlesitemaps": "^2.2|^3",
"tractorcow/silverstripe-robots": "^4.0",
"colymba/gridfield-bulk-editing-tools": "^3.1",
"symbiote/silverstripe-gridfieldextensions": "^3.6",
"undefinedoffset/sortablegridfield": "^2.2",
"tractorcow/silverstripe-fluent": "^6.0",
"silverstripe/crontask": "^2.6",


"silverstripe/mfa": "^4.8",



"ilateral/silverstripe-modern": "^1.5",

"pikselin/silverstripe-pagebanners": "dev-main"

```
