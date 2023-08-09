# Elemental

Elemental is required by this module along with a few supporting sub-modules. 

The following YAML config will enable elements on every `Page` object,
replacing the standard `Content` rich text field.

**app/_config/elements.yml**

```yaml
Page:
  extensions:
    - DNADesign\Elemental\Extensions\ElementalPageExtension
```

No default config is provided by this module in support of Elemental. See [this link](https://github.com/silverstripe/silverstripe-elemental/tree/5#installation) for how to extend a page type with Elemental. 

- [dnadesign/silverstripe-elemental](https://github.com/silverstripe/silverstripe-elemental)
- [dnadesign/silverstripe-elemental-virtual](https://github.com/dnadesign/silverstripe-elemental-virtual)
- [dnadesign/silverstripe-elemental-userforms](dnadesign/silverstripe-elemental-userforms)
- [fractas/elemental-stylings](https://github.com/fractaslabs/silverstripe-elemental-stylings)
- [dynamic/silverstripe-elemental-embedded-code](https://github.com/dynamic/silverstripe-elemental-embedded-code)
- [dnadesign/silverstripe-elemental-virtual](https://github.com/dnadesign/silverstripe-elemental-virtual)
- [silverstripers/elemental-search](https://github.com/SilverStripers/elemental-seach)
