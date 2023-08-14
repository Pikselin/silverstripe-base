<?php

use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\GridField\GridFieldPageCount;
use SilverStripe\Versioned\GridFieldArchiveAction;
use SilverStripe\View\TemplateGlobalProvider;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseHelpers implements TemplateGlobalProvider
{
    public static function get_template_global_variables()
    {
        return [
            'CurrentYear',
            'TimeLength'
        ];
    }

    /*
     * Gets the current calendar year
     */
    public static function CurrentYear(): string
    {
        return date('Y');
    }

    /*
     * converts an integer into a human readable length, useful for video embeds, podcasts etc.
     */
    public static function TimeLength(int $time): string
    {
        $l = (int)$time;
        $h = (int)($l / 60);
        $m = $l % 60;
        return (($h > 0) ? $h.' hours ' : '').($m > 0 ? $m.' mins' : '');
    }

    public static function json_validator($data) : bool {
    if (!empty($data)) {
        return is_string($data) && is_array(json_decode($data, true));
    }
    return false;
}

    public static function ThemeList(): array
    {
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
        return $themes;
    }

    public static function GridFieldConfig($sortField = false, $rows = 10, $addnew = true, $autocomplete = true, $filterheader = true, $pagecount = true, $actionmenu = true, $archive = true, $delete = false): GridFieldConfig_RelationEditor
    {

        $GridConf = GridFieldConfig_RelationEditor::create($rows);

        if ($delete !== false) {
            $GridConf->addComponent(new GridFieldDeleteAction());
        }

        if ($sortField !== false) {
            $GridConf->addComponent(new GridFieldOrderableRows($sortField));
        }

        $remove = [];

        if ($autocomplete == false) {
            $remove[] = GridFieldAddExistingAutocompleter::class;
        }

        if ($filterheader == false) {
            $remove[] = GridFieldFilterHeader::class;
        }

        if ($pagecount == false) {
            $remove[] = GridFieldPageCount::class;
        }

        if ($actionmenu == false) {
            $remove[] = GridFieldPageCount::class;
        }

        if ($archive == false) {
            $remove[] = GridFieldArchiveAction::class;
        }
        if ($addnew == false) {
            $remove[] = GridFieldAddNewButton::class;
        }

        if (count($remove) > 0) {
            $GridConf->removeComponentsByType($remove);
        }

        return $GridConf;
    }

}
