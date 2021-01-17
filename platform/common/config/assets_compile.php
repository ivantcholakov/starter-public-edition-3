<?php

// Compiling visual themes with Semantic/Fomantic UI might require a lot
// of memory for node.js. In such case try from a command line this (Linux):
// export NODE_OPTIONS=--max-old-space-size=8192

// An autoprefixer option: Supported browsers.

$config['autoprefixer_browsers'] = [
    '>= 0.1%',
    'last 2 versions',
    'Firefox ESR',
    'Safari >= 7',
    'iOS >= 7',
    'ie >= 10',
    'Edge >= 12',
    'Android >= 4',
];

// The following command-line runs all the tasks:
// php cli.php assets compile

$config['tasks'] = [

    // php cli.php assets compile editor-min

    [
        'name' => 'editor-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile semantic-ui-min

    [
        'name' => 'semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile semantic-ui-custom-min

    [
        'name' => 'semantic-ui-custom-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // -------------------------------------------------------------------------

    // php cli.php assets compile front-default-min

    [
        'name' => 'front-default-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile front-semantic-ui-flat-min

    [
        'name' => 'front-semantic-ui-flat-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // -------------------------------------------------------------------------
];

if (!function_exists('_assets_compile_create_md5')) {

    function _assets_compile_create_md5($task) {

        $destination_hash = $task['destination'].'.md5';
        $hash = md5($task['result']);

        if (!write_file($destination_hash, $hash)) {
            return false;
        }

        @chmod($destination_hash, FILE_WRITE_MODE);
    }
}

if (!function_exists('_assets_compile_create_sha384')) {

    function _assets_compile_create_sha384($task) {

        $destination_hash = $task['destination'].'.sha384';
        $hash = hash('sha384', $task['result']);

        if (!write_file($destination_hash, $hash)) {
            return false;
        }

        @chmod($destination_hash, FILE_WRITE_MODE);
    }
}

if (!function_exists('_assets_compile_create_sha384_base64')) {

    function _assets_compile_create_sha384_base64($task) {

        $destination_hash = $task['destination'].'.sha384.base64';
        $hash = base64_encode(hash('sha384', $task['result']));

        if (!write_file($destination_hash, $hash)) {
            return false;
        }

        @chmod($destination_hash, FILE_WRITE_MODE);
    }
}
