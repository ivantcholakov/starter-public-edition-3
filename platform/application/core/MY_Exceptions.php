<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    protected $ci = null;

    /**
     * Initialize execption class
     *
     * @return    void
     */
    public function __construct() {

        parent::__construct();

        if (function_exists('get_instance') && class_exists('CI_Controller', false)) {
            $this->ci = get_instance();
        }
    }

    // --------------------------------------------------------------------

    /**
     * 404 Page Not Found Handler
     *
     * @param   string  the page
     * @param   bool    log error yes/no
     * @return  string
     */
    public function show_404($page = '', $log_error = TRUE) {

        $heading = '404 Page Not Found';
        $message = 'The page you requested was not found.';

        // By default we log this, but allow a dev to skip it
        if ($log_error) {
            // Removed by Ivan Tcholakov, 12-OCT-2013.
            //log_message('error', '404 Page Not Found --> '.$_SERVER['REQUEST_URI']);
            //
        }

        require APPPATH . 'config/routes.php';

        if ($route['404_override'] != '' && is_object($this->ci)) {
            $this->ci->load->set_module('error_404');
            Modules::run($route['404_override'].'/index');
            set_status_header(404);
            echo $this->ci->output->get_output();
            exit(4); // EXIT_UNKNOWN_FILE
        }

        set_status_header(404);

        echo $this->show_error($heading, $message, 'error_404', 404);
        exit(4); // EXIT_UNKNOWN_FILE
    }

    // --------------------------------------------------------------------

    public function show_exception(Exception $exception)
    {
        $templates_path = config_item('error_views_path');
        if (empty($templates_path))
        {
            $templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
        }

        // Modified by Ivan Tcholakov, 30-OCT-2014.
        //$message = $exception->getMessage();
        $message = is_object($exception) ? $exception->getMessage() : null;
        //
        if (empty($message))
        {
            $message = '(null)';
        }

        if (is_cli())
        {
            $templates_path .= 'cli'.DIRECTORY_SEPARATOR;
        }
        else
        {
            set_status_header(500);
            $templates_path .= 'html'.DIRECTORY_SEPARATOR;
        }

        if (ob_get_level() > $this->ob_level + 1)
        {
            ob_end_flush();
        }

        ob_start();
        include($templates_path.'error_exception.php');
        $buffer = ob_get_contents();
        ob_end_clean();
        echo $buffer;
    }

}
