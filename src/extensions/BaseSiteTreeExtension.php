<?php

namespace Pikselin\base;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\ArrayData;

/**
 * Class \Pikselin\base\BaseSiteTreeExtension
 *
 * @property SiteTree|BaseSiteTreeExtension $owner
 * @property string $PB_Theme
 */
class BaseSiteTreeExtension extends DataExtension
{
    private static array $db = [
        'PB_Theme' => 'Text'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $ThemeField = DropdownField::create('PB_Theme', 'Override theme', \BaseHelpers::ThemeList())
            ->setDescription('Override the default sites theme for this page.')->setEmptyString('Default theme');

        $fields->addFieldToTab('Root.Theme', $ThemeField);
    }

    public function GACode()
    {
        $SiteConfig = SiteConfig::current_site_config();
        if (!empty($SiteConfig->GACode)) {
            $arrayData = new ArrayData([
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
            $arrayData = new ArrayData([
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
            $arrayData = new ArrayData([
                'TagManagerCode' => $SiteConfig->TagManager
            ]);

            return $arrayData->renderWith('TagManagerNoScript');
        }
        return false;
    }
}
