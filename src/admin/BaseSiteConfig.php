<?php

namespace Pikselin\base {

    use SilverStripe\Forms\DropdownField;
    use SilverStripe\Forms\EmailField;
    use SilverStripe\Forms\FieldList;
    use SilverStripe\Forms\TextField;
    use SilverStripe\ORM\DataExtension;

    class BaseSiteConfig extends DataExtension {

        private static $db = [
            'SiteEmail' => 'Text',
            'TagManager' => 'Text',
            'GACode' => 'Text',
            'OverrideTheme' => 'Varchar(255)',
//            'GoogleMapsAPIKey' => 'Text',
//            'YouTubeAPIKey' => 'Text',
        ];

        public function updateCMSFields(FieldList $fields) {
            $fields->addFieldToTab('Root.Main', EmailField::create('SiteEmail', 'General Email address'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('TagManager', 'Google Tag Manager key'));
            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('GACode', 'Google Analytics key'));

//            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('GoogleMapsAPIKey', 'Google Maps API Key (Javascript)')
//                            ->setAttribute('placeholder', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx')
//                            ->setDescription('Enter your Google Maps API Key here. obtain one from <a target="_blank" href="https://console.developers.google.com">Google developers console</a>. Create a browser javascript API key.')
//            );
//
//            $fields->addFieldToTab('Root.3rdPartyTools', TextField::create('YouTubeAPIKey', 'YouTube API Key')
//                            ->setAttribute('placeholder', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx')
//                            ->setDescription('Enter your YouTube API Key here. obtain one from <a target="_blank" href="https://console.developers.google.com">Google developers console</a>.')
//            );

            $themes = [];
            if (is_dir(THEMES_PATH)) {
                foreach (scandir(THEMES_PATH) as $theme) {
                    if ($theme[0] == '.') {
                        continue;
                    }
                    $theme = strtok($theme, '_');
                    $themes[$theme] = $theme;
                }
                ksort($themes);
            }

            $ThemeField = DropdownField::create('OverrideTheme', 'Override theme', $themes)->setDescription('Override the default theme for this site.')->setEmptyString('(Choose a theme)');

            $fields->addFieldToTab('Root.Main', $ThemeField);
        }

    }

}