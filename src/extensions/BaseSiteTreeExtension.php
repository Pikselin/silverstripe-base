<?php

namespace Pikselin\base;

use SilverStripe\Core\Extension;
use BaseHelpers;
use SilverStripe\Model\ArrayData;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Class \Pikselin\base\BaseSiteTreeExtension
 *
 * @property SiteTree|BaseSiteTreeExtension $owner
 * @property ?string $PB_Theme
 * @extends Extension<(SiteTree & static)>
 */
class BaseSiteTreeExtension extends Extension
{
    private static array $db = [
        'PB_Theme' => 'Text'
    ];

    protected function updateCMSFields(FieldList $fields)
    {
        $ThemeField = DropdownField::create('PB_Theme', 'Override theme', BaseHelpers::ThemeList())
            ->setDescription('Override the default sites theme for this page.')->setEmptyString('Default theme');

        $fields->addFieldToTab('Root.Theme', $ThemeField);
    }

    public function GACode()
    {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->GACode)) {
            $arrayData = ArrayData::create([
                'GACode'      => $SiteConfig->GACode,
                'StoredNonce' => $this->owner->StoredNonce()
            ]);

            return $arrayData->renderWith('GACode');
        }

        return false;
    }

    public function TagManagerCode()
    {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->TagManager)) {
            $arrayData = ArrayData::create([
                'TagManagerCode' => $SiteConfig->TagManager,
                'StoredNonce'    => $this->owner->StoredNonce()
            ]);

            return $arrayData->renderWith('TagManagerCode');
        }

        return false;
    }

    public function TagManagerNoScript()
    {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->TagManager)) {
            $arrayData = ArrayData::create([
                'TagManagerCode' => $SiteConfig->TagManager
            ]);

            return $arrayData->renderWith('TagManagerNoScript');
        }

        return false;
    }
}
