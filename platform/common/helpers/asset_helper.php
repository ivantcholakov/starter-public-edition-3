<?php defined('BASEPATH') OR exit('No direct script access allowed.');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package      CodeIgniter
 * @author       Rick Ellis
 * @copyright    Copyright (c) 2006, pMachine, Inc.
 * @license      https://www.codeigniter.com/userguide3/license.html
 * @link         https://www.codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Asset Helpers
 *
 * @package      CodeIgniter
 * @subpackage   Helpers
 * @category     Helpers
 * @author       Philip Sturgeon < email@philsturgeon.co.uk >
 */

// ------------------------------------------------------------------------

if (!function_exists('css')) {

    function css($asset_name, $module_name = NULL, $attributes = array()) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->css($asset_name, $module_name, $attributes);
    }

}

if (!function_exists('theme_css')) {

    function theme_css($asset, $attributes = array()) {

        return css($asset, '_theme_', $attributes);
    }

}

if (!function_exists('css_url')) {

    function css_url($asset_name, $module_name = NULL) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->css_url($asset_name, $module_name);
    }

}

if (!function_exists('theme_css_url')) {

    function theme_css_url($asset_name) {

        return css_url($asset_name, '_theme_');
    }

}

if (!function_exists('css_path')) {

    function css_path($asset_name, $module_name = NULL) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->css_path($asset_name, $module_name);
    }

}

if (!function_exists('theme_css_path')) {

    function theme_css_path($asset_name) {

        return css_path($asset_name, '_theme_');
    }

}

// ------------------------------------------------------------------------

if (!function_exists('image')) {

    function image($asset_name, $module_name = NULL, $attributes = array()) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->image($asset_name, $module_name, $attributes);
    }

}

if (!function_exists('theme_image')) {

    function theme_image($asset, $attributes = array()) {

        return image($asset, '_theme_', $attributes);
    }

}

if (!function_exists('image_url')) {

    function image_url($asset_name, $module_name = NULL) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->image_url($asset_name, $module_name);
    }

}

if (!function_exists('theme_image_url')) {

    function theme_image_url($asset_name) {

        return image_url($asset_name, '_theme_');
    }

}

if (!function_exists('image_path')) {

    function image_path($asset_name, $module_name = NULL) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->image_path($asset_name, $module_name);
    }

}

if (!function_exists('theme_image_path')) {

    function theme_image_path($asset_name) {

        return image_path($asset_name, '_theme_');
    }

}

// ------------------------------------------------------------------------

if (!function_exists('js')) {

    function js($asset_name, $module_name = NULL, $attributes = array()) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->js($asset_name, $module_name, $attributes);
    }

}

if (!function_exists('theme_js')) {

    function theme_js($asset, $attributes = array()) {

        return js($asset, '_theme_', $attributes);
    }

}

if (!function_exists('js_url')) {

    function js_url($asset_name, $module_name = NULL) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->js_url($asset_name, $module_name);
    }

}

if (!function_exists('theme_js_url')) {

    function theme_js_url($asset_name) {

        return js_url($asset_name, '_theme_');
    }

}

if (!function_exists('js_path')) {

    function js_path($asset_name, $module_name = NULL) {

        $CI =& get_instance();
        $CI->load->library('asset');
        return $CI->asset->js_path($asset_name, $module_name);
    }

}

if (!function_exists('theme_js_path')) {

    function theme_js_path($asset_name) {

        return js_path($asset_name, '_theme_');
    }

}
