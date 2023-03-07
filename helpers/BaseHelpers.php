<?php

use SilverStripe\View\TemplateGlobalProvider;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseHelpers implements TemplateGlobalProvider {

    public static function get_template_global_variables() {
        return [
            'CurrentYear',
            'VideoLength'
        ];
    }

    /*
     * Gets the current calendar year
     */
    public static function CurrentYear() {
        return date('Y');
    }

    /*
     * converts an integer into a human readable length, useful for video embeds, podcasts etc.
     */
    public static function TimeLength(int $time) {
        $l = (int)$time;
        $h = (int)($l / 60);
        $m = $l % 60;
        return (($h > 0) ? $h.' hours ' : '').($m > 0 ? $m.' mins' : '');
    }

}
