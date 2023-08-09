# Global config

A number of additional fields are available from **admin/settings**. 

## Site email
This module adds a simple site email field to **admin/settings**. Access it via

```html
    $SiteConfig.SiteEmail
```
## Google Analytics

Add the Google Analytics key in here and then add a template call to include Google Analytics. Note that the template can be overridden by copying **templates/GACode.ss** to your theme **templates/** directory.
Tag manager and GA4. Just add the account ID for one of these to have them included

### Google Analytics template variable

```html
    <% if $GACode %>$GACode<% end_if %>
```
## Google Tag Manager

Add the Tag Manager key in here and then add the template calls to include Tag Manager. Note that the templates can be overridden by copying **templates/TagManagerCode.ss** & **templates/TagManagerNoScript.ss** to your theme **templates/** directory.

### Google Tag Manager template variables

```html 
    <% if $TagManagerNoScript %>$TagManagerNoScript<% end_if %>

    <% if $TagManagerCode %>$TagManagerCode<% end_if %>
```
## Google Maps API Key

Coming soon

## YouTube API Key

Coming soon

# Site themes

This module adds functionality to set the theme from the CMS .

In this context, you have the ability to define a global theme for the entire website, which will take precedence over any theme that is hardcoded into the website's configuration. The global theme can be set at a central location to ensure consistency across the site.

However, it's important to note that you also have the option to override the global theme on a page-by-page basis. Each page has a "Theme" tab where you can specify a different theme for that specific page. If you choose to set a theme on a particular page, its child pages will inherit the same theme unless they have their own individual theme specified.
For example, if you have a page structure like this:
- Root Page
    - About Us
    - My Page

If you set a theme on the "About Us" page, the "My Page" under it will automatically use the same theme. But if you later decide to set a different theme for "My Page," it will override the inherited theme from "About Us."
In summary, you have the flexibility to set a global theme for the entire site, and at the same time, you can fine-tune the theme on specific pages using the "Theme" tab. Page-level themes are inherited from parent pages unless individually specified.

