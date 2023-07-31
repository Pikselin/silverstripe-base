<?php

namespace Pikselin\base {

    use SilverStripe\Forms\DropdownField;
    use SilverStripe\Forms\EmailField;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Forms\LiteralField;
    use SilverStripe\Forms\TextField;
    use SilverStripe\ORM\DataExtension;

    class BaseSiteConfig extends DataExtension
    {
        private static $db = [
            'SiteEmail'     => 'Text',
            'TagManager'    => 'Text',
            'GACode'        => 'Text',
            'OverrideTheme' => 'Varchar(255)',
//            'GoogleMapsAPIKey' => 'Text',
//            'YouTubeAPIKey' => 'Text',
        ];

        public function updateCMSFields(FieldList $fields)
        {
            $fields->addFieldToTab('Root.Main', EmailField::create('SiteEmail', 'General Email address'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('TagManager', 'Google Tag Manager key'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('GACode', 'Google Analytics key'));



            $ThemeField = DropdownField::create('OverrideTheme', 'Override theme', \BaseHelpers::ThemeList())->setDescription('Override the default theme for this site.')->setEmptyString('(Choose a theme)');
            $ThemeFieldDesc = LiteralField::create('ThemeFieldDesc', file_get_contents(dirname(__FILE__, 3)).'/files/theme-help.html');
            $fields->addFieldToTab('Root.Theme', $ThemeField);
            $fields->addFieldToTab('Root.Theme', $ThemeFieldDesc);
        }
    }

}
