# Extensions

## Teaser extension
An extension is included that allows you to add teaser text and teaser image fields to any page type. This is useful when you want to display child pages in lists on landing pages with a specific image and lead text.

To activate the extension add it via the extensions static:

```php
private static $extensions = [
    TeaserExtension::class
];
```
Or in yml

**app/_config/extensions.yml**

```yaml
Page:
  extensions:
    - Pikselin\base\TeaserExtension
```

## Image upload validator class
Simple image upload validation for forms

example:

```php
$Image = new UploadField('Image', 'Image');
$Image->setDescription('');
$validator = new ImageUpload_Validator();
$validator->setMinDimensions(500, 400);
$validator->setAllowedExtensions(array('jpg', 'jpeg', 'png'));
$Image->setValidator($validator);
```
