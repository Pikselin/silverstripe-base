<?php

use SilverStripe\Assets\Upload_Validator;

class ImageUpload_Validator extends Upload_Validator {

  public $minwidth;
  public $minheight;

  public function setMinDimensions($width, $height) {
    if (is_numeric($width) && intval($width) >= 0) {
      $this->minwidth = intval($width);
    } else {
      user_error('Invalid minimum width, value must be numeric and at least 0', E_USER_ERROR);
    }if (is_numeric($height) && intval($height) >= 0) {
      $this->minheight = intval($height);
    } else {
      user_error('Invalid minimum height, value must be numeric and at least 0', E_USER_ERROR);
    }
  }

  public function isValidDimensions() {
    //if we cannot determine the image size return false
    if (!$dims = getimagesize($this->tmpFile['tmp_name'])) {
      return false;
    }
    if (($this->minheight && $dims[1] < $this->minheight) || ($this->minwidth && $dims[0] < $this->minwidth)) {
      return false;
    }
    return true;
  }

  public function validate() {
    if (!isset($this->tmpFile['name']) || empty($this->tmpFile['name'])) {
      return true;
    }
    if (!$this->isValidDimensions()) {
      $this->errors[] = sprintf('Minimum image size is %s x %s ', $this->minwidth ? $this->minwidth . 'px' : '(ANY)', $this->minheight ? $this->minheight . 'px' : '(ANY)');
      return false;
    }
    return parent::validate();
  }

}
