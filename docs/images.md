# Images

A number of modules are included to assist with image manipulation

## Alt image text

[purplespider/asset-alt-text](https://addons.silverstripe.org/add-ons/purplespider/asset-alt-text)

## How to use

Go to the Files and select an image to see the new field.

To make use of the alt text value in your templates, just use $AltText. e.g.:

```html
<% with BannerImage %>
<img src="$URL" width="$Width" height="$Height" alt="$AltText" />
<% end_with %>
```
## Image focus point

[jonom/focuspoint](https://github.com/jonom/silverstripe-focuspoint)

See the documentation for details of how to use the focal point on images.

# Responsive images

[heyday/silverstripe-responsive-images](https://github.com/heyday/silverstripe-responsive-images)

## How to use

Once you have this module installed, you’ll need to configure named sets of image sizes in your site’s yaml config (eg. **mysite/_config/images.yml**). Note that there are no default image sets, but you can copy the config below to get started:

```yaml
---
After: 'silverstripe-responsive-images/*'
---
Heyday\ResponsiveImages\ResponsiveImageExtension:
sets:
ResponsiveSet1:
css_classes: classname
arguments:
'(min-width: 1200px)': [800]
'(min-width: 800px)': [400]
'(min-width: 200px)': [100]

    ResponsiveSet2:
      template: Includes/MyCustomImageTemplate
      method: Fill
      arguments:
        '(min-width: 1000px) and (min-device-pixel-ratio: 2.0)': [1800, 1800]
        '(min-width: 1000px)': [900, 900]
        '(min-width: 800px) and (min-device-pixel-ratio: 2.0)': [1400, 1400]
        '(min-width: 800px)': [700, 700]
        '(min-width: 400px) and (min-device-pixel-ratio: 2.0)': [600, 600]
        '(min-width: 400px)': [300, 300]
      default_arguments: [1200, 1200]

    ResponsiveSet3:
      method: Pad
      arguments:
        '(min-width: 800px)': [700, 700, '666666']
        '(min-width: 400px)': [300, 300, '666666']
      default_arguments: [1200, 1200, '666666']
```

Now, run `?flush=1` to refresh the config manifest, and you will have the new methods injected into your Image class that you can use in templates.

```html
$MyImage.ResponsiveSet1
$MyImage.ResponsiveSet2
$MyImage.ResponsiveSet3
````

The output of the first method (**ResponsiveSet1**) will look something like this, remember that the first matching media-query will be taken:
```html
<picture>
        <source media="(min-width: 1200px)" srcset="/assets/Uploads/_resampled/SetWidth100-my-image.jpeg">

        <source media="(min-width: 800px)" srcset="/assets/Uploads/_resampled/SetWidth400-my-image.jpeg">

        <source media="(min-width: 200px)" srcset="/assets/Uploads/_resampled/SetWidth100-my-image.jpeg">

    <img src="/assets/Uploads/_resampled/SetWidth640480-my-image.jpeg" alt="my-image.jpeg">
</picture>
```

The final output to your browser will place the correct image URL into one of the span tags and only one image will render. As the window is resized, new images are loaded into the DOM.

### Other options
Each set should have a "default_arguments" property set in case the browser does not support media queries. By default, the "default_arguments" property results in an 800x600 image, but this can be overridden in the config.

```yml
Heyday\ResponsiveImages\ResponsiveImageExtension:
  default_arguments: [1200, 768]
```
You can also pass arguments for the default image at the template level.

```html
$MyImage.MyResponsiveSet(900, 600)
```

The default resampling method is **SetWidth**, but this can be overridden in your config.

```yml
Heyday\ResponsiveImages\ResponsiveImageExtension:
  default_method: Fill
```

It can also be passed into your template function.

```html
$MyImage.MyResponsiveSet('Fill', 800, 600)
```
