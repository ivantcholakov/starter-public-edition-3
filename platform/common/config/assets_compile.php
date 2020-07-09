<?php

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

    // SCSS --------------------------------------------------------------------

    // php cli.php assets compile sweetalert-min sweetalert-custom-min sweetalert-facebook-min sweetalert-google-min sweetalert-twitter-min

    // php cli.php sweetalert sweetalert-min

    [
        'name' => 'sweetalert-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-custom-min

    [
        'name' => 'sweetalert-custom-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert-custom.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert-custom.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-facebook-min

    [
        'name' => 'sweetalert-facebook-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-google-min

    [
        'name' => 'sweetalert-google-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-twitter-min

    [
        'name' => 'sweetalert-twitter-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // LESS --------------------------------------------------------------------

    // php cli.php less compile editor-min

    [
        'name' => 'editor-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile datatables-semantic-ui-min

    [
        'name' => 'datatables-semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.semanticui.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile datatables-responsive-semantic-ui-min

    [
        'name' => 'datatables-responsive-semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/responsive.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/responsive.semanticui.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile datatables-select-semantic-ui-min

    [
        'name' => 'datatables-select-semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/select.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/select.semanticui.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile semantic-ui-min

    [
        'name' => 'semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile semantic-ui-custom-min

    [
        'name' => 'semantic-ui-custom-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-flat-min

    [
        'name' => 'front-semantic-ui-flat-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-default-min

    [
        'name' => 'front-default-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // -------------------------------------------------------------------------
];
