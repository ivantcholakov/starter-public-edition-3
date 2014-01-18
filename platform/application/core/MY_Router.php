<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
if (!class_exists('MX_Router', false)) {
    require APPPATH.'third_party/MX/Router.php';
}

class MY_Router extends MX_Router {

    public function __construct() {

        parent::__construct();
    }

}
