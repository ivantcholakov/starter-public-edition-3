<?php defined('BOOTSTRAPPATH') OR exit('No direct script access allowed');

/**
 * A Custom Bootstrap File
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013 - 2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * The allowed modes are:
 *
 *     development
 *     testing
 *     production
 *
 */

if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');
}

if (!in_array(ENVIRONMENT, array('development', 'testing', 'production'))) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The application environment is not set correctly.';
    exit(1); // EXIT_ERROR
}


if ( ! function_exists('is_php'))
{
    /**
     * Determines if the current version of PHP is equal to or greater than the supplied value
     *
     * @param       string
     * @return      bool        TRUE if the current version is $version or higher
     */
    function is_php($version)
    {
        static $_is_php;
        $version = (string) $version;

        if ( ! isset($_is_php[$version]))
        {
            $_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
        }

        return $_is_php[$version];
    }
}

/*
 *---------------------------------------------------------------
 * Get and check version data
 *---------------------------------------------------------------
 */

require BOOTSTRAPPATH.'versions.php';


/*
 * --------------------------------------------------------------------
 * Environment and request type detection
 * --------------------------------------------------------------------
 */

define('IS_PHP_5_1', is_php('5.1.0'));  // DEPRECATED
define('IS_PHP_5_2', is_php('5.2.0'));  // DEPRECATED
define('IS_PHP_5_3', is_php('5.3.0'));  // DEPRECATED
define('IS_PHP_5_4', is_php('5.4.0'));  // DEPRECATED
define('IS_PHP_5_5', is_php('5.5.0'));  // DEPRECATED
define('IS_WINDOWS_OS', strtolower(substr(php_uname('s'), 0, 3 )) == 'win');
define('IS_CLI', (PHP_SAPI == 'cli') || defined('STDIN'));
define('IS_CLI_REQUEST', IS_CLI);       // DEPRECATED, use IS_CLI instead.
define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

define('ICONV_INSTALLED', function_exists('iconv'));                // DEPRECATED
define('MBSTRING_INSTALLED', extension_loaded('mbstring'));         // DEPRECATED
define('PCRE_UTF8_INSTALLED', @preg_match('/./u', 'é') === 1);      // DEPRECATED
define('INTL_INSTALLED', function_exists('intl_get_error_code'));   // DEPRECATED

// Fix $_SERVER['REQUEST_URI'] if it is missing.
if (!isset($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '') {
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
        $_SERVER['REQUEST_URI'] .= '?'.$_SERVER['QUERY_STRING'];
    }
}


/*
 * --------------------------------------------------------------------
 * Setting and validation of platform paths.
 * --------------------------------------------------------------------
 */

if (isset($FCPATH)) {
    define('FCPATH', rtrim(str_replace('\\', '/', realpath($FCPATH)), '/').'/');
} else {
    define('FCPATH', '');
}

// Check the path to the front controller.
if (FCPATH == '' || FCPATH == '/' || !is_dir(FCPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your front controller directory path (FCPATH) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

if (isset($DEFAULTFCPATH)) {
    define('DEFAULTFCPATH', rtrim(str_replace('\\', '/', realpath($DEFAULTFCPATH)), '/').'/');
} else {
    define('DEFAULTFCPATH', '');
}

// Check the path to the front controller of the default site.
if (DEFAULTFCPATH == '' || DEFAULTFCPATH == '/' || !is_dir(DEFAULTFCPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your front controller directory path of the default site (DEFAULTFCPATH) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

if (isset($PLATFORMPATH)) {
    define('PLATFORMPATH', rtrim(str_replace('\\', '/', realpath($PLATFORMPATH)), '/').'/');
} else {
    define('PLATFORMPATH', '');
}

// Check the path to the "platform" directory.
if (PLATFORMPATH == '' || PLATFORMPATH == '/' || !is_dir(PLATFORMPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your platform directory ($PLATFORMPATH) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

if (isset($PLATFORMRUN)) {
    define('PLATFORMRUN', str_replace('\\', '/', realpath($PLATFORMRUN)));
} else {
    define('PLATFORMRUN', '');
}

// Check the path to the platform "run" file.
if (PLATFORMRUN == '' || !is_file(PLATFORMRUN)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your platform starter file ($PLATFORMRUN) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

if (isset($PLATFORMCREATE)) {
    define('PLATFORMCREATE', str_replace('\\', '/', realpath($PLATFORMCREATE)));
} else {
    define('PLATFORMCREATE', '');
}

// Check the path to the platform "create" file.
if (PLATFORMCREATE == '' || !is_file(PLATFORMCREATE)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your platform initialization file ($PLATFORMCREATE) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

if (isset($PLATFORMDESTROY)) {
    define('PLATFORMDESTROY', str_replace('\\', '/', realpath($PLATFORMDESTROY)));
} else {
    define('PLATFORMDESTROY', '');
}

// Check the path to the platform "destroy" file.
if (PLATFORMDESTROY == '' || !is_file(PLATFORMDESTROY)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your platform destruction file ($PLATFORMDESTROY) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

// Multiple applications are implemented in Starter 4.
define('APPSPATH', null);

if (isset($APPNAME)) {
    define('APPNAME', trim(str_replace(array('\\', '-'), array('/', '_'), $APPNAME), ' /'));
} else {
    define('APPNAME', '');
}

if (isset($DEFAULTAPPNAME)) {
    define('DEFAULTAPPNAME', trim(str_replace(array('\\', '-'), array('/', '_'), $DEFAULTAPPNAME), ' /'));
} else {
    define('DEFAULTAPPNAME', '');
}

// The url segment of the application, counted from the root public directory of the site.
define('APPSEGMENT', rtrim(str_replace(DEFAULTFCPATH, '', FCPATH), '/'));

// Is this application default (i.e. at the root public directory of the site)?
define('ISDEFAULTAPP', APPSEGMENT == '');

// The path to the application.
define('APPPATH', PLATFORMPATH.'application/');

// Check the path to the application directory.
if (!is_dir(APPPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your application root directory path (APPPATH) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

if (!isset($SELF)) {
    define('SELF', 'index.php');
} else {
    define('SELF', $SELF);
}

// Check the path to the front controller.
if (!is_file(FCPATH.SELF)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your front controller file name ($SELF) does not appear to be set correctly.';
    exit(3); // EXIT_CONFIG
}

// The path to the Composer loader file.
define('COMPOSER_PATH', PLATFORMPATH.'vendor/autoload.php');

if (!is_file(COMPOSER_PATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your path to the Composer loader file (COMPOSER_PATH) does not appear to be set correctly. Please, make corrections within the following file: '.__FILE__;
    exit(3); // EXIT_CONFIG
}

define('VENDORPATH', rtrim(str_replace('\\', '/', realpath(dirname(COMPOSER_PATH))), '/').'/');

// Path to the system directory
define('BASEPATH', VENDORPATH.'codeigniter/framework/system/');

// Is the system path correct?
if (BASEPATH == '' || BASEPATH == '/' || !is_dir(BASEPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your system directory path (BASEPATH) does not appear to be set correctly. Please, make corrections within the following file: '.__FILE__;
    exit(3); // EXIT_CONFIG
}

// Name of the "system directory"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

// The path to the "views" directory
define('VIEWPATH', APPPATH.'views/');

// The path to the "common" directory
define('COMMONPATH', rtrim(str_replace('\\', '/', realpath(dirname(__FILE__).'/../common')), '/').'/');

if (COMMONPATH == '' || COMMONPATH == '/' || !is_dir(COMMONPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your common directory path (COMMONPATH) does not appear to be set correctly. Please, make corrections within the following file: '.__FILE__;
    exit(3); // EXIT_CONFIG
}

// This is the common writable directory to be used by this platform.
define('WRITABLEPATH', rtrim(str_replace('\\', '/', realpath(dirname(__FILE__).'/../writable')), '/').'/');

if (WRITABLEPATH == '' || WRITABLEPATH == '/' || !is_dir(WRITABLEPATH)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your writable directory path (WRITABLEPATH) does not appear to be set correctly. Please, make corrections within the following file: '.__FILE__;
    exit(3); // EXIT_CONFIG
}

// The PHP file extension. DEPRECATED
define('EXT', '.php');

// Making sure PEAR packages are to be searched in this site first
set_include_path(COMMONPATH.'third_party/pear'.PATH_SEPARATOR.get_include_path());

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);


/*
 * --------------------------------------------------------------------
 * Various helper functions
 * --------------------------------------------------------------------
 */

require BOOTSTRAPPATH.'print_d.php';
require BOOTSTRAPPATH.'helpers.php';

if (!function_exists('http_build_str') || !function_exists('http_build_url')) {
    require BOOTSTRAPPATH.'http_build_url.php';
}

require BASEPATH.'core/compat/standard.php';

if (!function_exists('secure_random_bytes')) {
    require BOOTSTRAPPATH.'srand/srand.php';
}


/*
 *---------------------------------------------------------------------
 * Base URL detection
 *---------------------------------------------------------------------
 */
$DETECT_URL = detect_url();    // A deprecated global variable.
define('DETECTED_BASE_URL', detect_url('base_url'));


/*
 * --------------------------------------------------------------------
 * Load PHP environment settings
 * --------------------------------------------------------------------
 */

if (file_exists(COMMONPATH.'config/environment.php')) {
    include COMMONPATH.'config/environment.php';
}

if (file_exists(COMMONPATH.'config/boot/'.ENVIRONMENT.'.php')) {
    include COMMONPATH.'config/boot/'.ENVIRONMENT.'.php';
}

if (file_exists(APPPATH.'config/environment.php')) {
    include APPPATH.'config/environment.php';
}

if (file_exists(APPPATH.'config/boot/'.ENVIRONMENT.'.php')) {
    include APPPATH.'config/boot/'.ENVIRONMENT.'.php';
}


/*
 * --------------------------------------------------------------------
 * A custom PHP5-style autoloader
 * --------------------------------------------------------------------
 */
require BOOTSTRAPPATH.'autoload.php';
