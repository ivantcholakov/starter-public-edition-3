<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists('MX_Controller', false)) {
    require COMMONPATH.'third_party/MX/Controller.php';
}

class Core_Controller extends MX_Controller {

    public $module;
    public $controller;
    public $method;

    public $parse_i18n;

    public function __construct() {

        parent::__construct();

        $ci = get_instance();

        $this->module = $this->router->fetch_module();
        $this->controller = $this->router->class;
        $this->method = $this->router->method;

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;    // Hack to make form validation work properly with HMVC.
                                                // See https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home

        // See http://devzone.zend.com/1441/zend-framework-and-translation/
        $this->parse_i18n = (bool) $this->config->item('parse_i18n');

        $this->load
            ->library('registry')
            ->library('settings')
            ->helper('url')
            ->helper('language')
            ->language('ui')
        ;
    }

    // --------------------------------------------------------------

    /**
     * Generic callback used to call callback methods for form validation.
     *
     * @param string
     *        - the value to be validated
     * @param string
     *        - a comma separated string that contains the model name, method name
     *          and any optional values to send to the method as a single parameter.
     *          First value is the name of the model.
     *          Second value is the name of the method.
     *          Any additional values are values to be send in an array to the method.
     *
     *      EXAMPLE RULE:
     *  callback_external_callbacks[some_model,some_method,some_string,another_string]
     *
     * @author skunkbad (forum alias), http://ellislab.com/forums/member/93974/
     * @link http://ellislab.com/forums/viewthread/205469/
     * @link https://gist.github.com/1503599
     *
     * CodeIgniter 2.1.0 form validation external callbacks.
     *
     * This is part of MY_Controller.php in Community Auth, which is an open
     * source authentication application for CodeIgniter 2.1.0
     *
     * @package     Community Auth
     * @author      Robert B Gottier
     * @copyright   Copyright (c) 2011, Robert B Gottier.
     * @license     BSD - http://http://www.opensource.org/licenses/BSD-3-Clause
     * @link        http://community-auth.com
     */
    public function external_callbacks( $postdata, $param ) {

        $param_values = explode( ',', $param );

        // Make sure the model is loaded.
        $model = $param_values[0];
        $this->load->model( $model );

        // Rename the second element in the array for easy usage.
        // Modified by Ivan Tcholakov, 27-NOV-2012.
        //$method = $param_values[1];
        $method = trim($param_values[1]);
        //

        // Check to see if there are any additional values to send as an array.
        if ( count( $param_values ) > 2 ) {

            // Remove the first two elements in the param_values array.
            array_shift( $param_values );
            array_shift( $param_values );

            $argument = $param_values;
        }

        // Do the actual validation in the external callback.
        if ( isset( $argument ) ) {
            $callback_result = $this->$model->$method( $postdata, $argument );
        } else {
            $callback_result = $this->$model->$method( $postdata );
        }

        return $callback_result;
    }

    // --------------------------------------------------------------

}
