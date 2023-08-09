# Global template helpers

A simple class is included that provides a few basic reusable static methods for templates. See the helpers dir for details. Helper methods should be simple and agnostic. More complex methods should be contained in classes with more specific meaning.

Helpers can be accessed in templates by calling the method name:

```html
$CurrentYear
```
Or in code:
```php
BaseHelpers::CurrentYear();
```
See [BaseHelpers.php](../src/helpers/BaseHelpers.php) for more information.
