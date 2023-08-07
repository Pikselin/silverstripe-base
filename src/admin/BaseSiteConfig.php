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
            'PB_OverrideTheme' => 'Varchar(255)',
            'GoogleMapsAPIKey' => 'Varchar(255)',
            'YouTubeAPIKey' => 'Varchar(255)',
        ];

        public function updateCMSFields(FieldList $fields)
        {
            // clear fields incase another module has set them in config
            $fields->removeByName('TagManager');
            $fields->removeByName('GACode');
            $fields->removeByName('GoogleMapsAPIKey');
            $fields->removeByName('YouTubeAPIKey');

            $fields->addFieldToTab('Root.Main', EmailField::create('SiteEmail', 'General Email address'));
            $APIKeysLead = LiteralField::create('APIKeysLead','<p>Some features will require API keys in order to access functions such as website tracking or video embedding. Enter API keys below for the features required by this site.</p>');
            $fields->addFieldToTab('Root.3rdPartyTools', $APIKeysLead);
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('TagManager', 'Google Tag Manager key')->setDescription('<a href="https://support.google.com/tagmanager/answer/6103696?hl=en" target="_blank">Set up and install Google Tag Manager</a>'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('GACode', 'Google Analytics key')->setDescription('<a href="https://support.google.com/analytics/answer/9304153?hl=en" target="_blank">Set up and install Google Analytics</a>'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('GoogleMapsAPIKey', 'Google Maps API key')->setDescription('<a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">Set up and install Google Maps API key</a>'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('YouTubeAPIKey', 'YouTube API key')->setDescription('<a href="https://developers.google.com/youtube/v3/getting-started" target="_blank">Get a YouTube API key</a>'));



            $ThemeField = DropdownField::create('PB_OverrideTheme', 'Override theme', \BaseHelpers::ThemeList())->setDescription('Override the default theme for this site.')->setEmptyString('(Choose a theme)');
            $ThemeFieldDesc = LiteralField::create('ThemeFieldDesc', file_get_contents(dirname(__FILE__, 3).'/files/theme-help.html'));
            $fields->addFieldToTab('Root.Theme', $ThemeField);
            $fields->addFieldToTab('Root.Theme', $ThemeFieldDesc);
        }
    }

}
