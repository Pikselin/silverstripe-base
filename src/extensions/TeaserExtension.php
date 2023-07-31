<?php

namespace Pikselin\base;

use ImageUpload_Validator;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;

class TeaserExtension extends DataExtension
{
    private static $db = [
        'TeaserText' => 'HTMLText'
    ];
    private static $has_one = [
        'TeaserImage' => Image::class
    ];
    private static $owns = [
        'TeaserImage'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $TeaserLead = LiteralField::create('TeaserLead', '<p>Add text and an image that will be used when this page is displayed in a teaser context such as when being listed as a sub page or used in a featured block.</p>');

        $TeaserText = HTMLEditorField::create('TeaserText', 'Teaser Text')->setRows(5);

        $TeaserImage = UploadField::create('TeaserImage', 'Thumbnail Image');
        $TeaserImage->setFolderName('PageTeaserImage');
        $TeaserImage->setDescription('Used when displayed on the sector page.');

        $Teaservalidator = new ImageUpload_Validator();
        $Teaservalidator->setMinDimensions(640, 480);
        $Teaservalidator->setAllowedExtensions(['jpg', 'jpeg', 'png']);

        $TeaserImage->setValidator($Teaservalidator);

        $fields->addFieldToTab('Root.Teaser', $TeaserLead);
        $fields->addFieldToTab('Root.Teaser', $TeaserText);
        $fields->addFieldToTab('Root.Teaser', $TeaserImage);
    }

    public function TeaserImg()
    {
        if ($this->owner->TeaserImage()->URL !== '') {
            return $this->owner->TeaserImage()->Fill(640, 480);
        }
        return false;
    }

    public function TeaserImgMid()
    {
        if ($this->owner->TeaserImage() !== '') {
            return $this->owner->TeaserImage()->Fill(640, 480);
        }
        return false;
    }

    public function TeaserImgWide()
    {
        if ($this->owner->TeaserImage()) {
            return $this->owner->TeaserImage()->Fill(640, 480);
        }
        return false;
    }
}
