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
            $ThemeFieldDesc = LiteralField::create('ThemeFieldDesc', 'You can set the sites global theme here to override the one hard coded into the sites configuration. Note that you can also override the theme on a page by page basis. This can be controlled via the "Theme" tab on each page. Page level themes are inherited from page parents so if you have a page structure of root > about us > my page and set a theme on "about us" then "my page" will use the theme set on "about us"');
            $fields->addFieldToTab('Root.Theme', $ThemeField);
            $fields->addFieldToTab('Root.Theme', $ThemeFieldDesc);
        }
    }

}
